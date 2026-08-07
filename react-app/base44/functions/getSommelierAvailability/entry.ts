const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { createClientFromRequest } from 'npm:@base44/sdk@0.8.40';

/**
 * getSommelierAvailability — trả về các khoảng bận (busy) của Sommelier
 * trong một ngày, dựa trên Google Calendar (shared connector).
 *
 * Input:  { date: "YYYY-MM-DD" }  (múi giờ Asia/Ho_Chi_Minh)
 * Output: { date, busy: [{ start, end }] }  (ISO 8601, offset +07:00)
 */
Deno.serve(async (req) => {
  try {
    const base44 = createClientFromRequest(req);
    const body = await req.json().catch(() => ({}));
    const date = typeof body?.date === 'string' ? body.date : '';

    if (!/^\d{4}-\d{2}-\d{2}$/.test(date)) {
      return Response.json({ error: 'Invalid date (YYYY-MM-DD required)' }, { status: 400 });
    }

    const { accessToken } = await db.asServiceRole.connectors.getConnection('googlecalendar');

    const timeMin = `${date}T00:00:00+07:00`;
    const timeMax = `${date}T23:59:59+07:00`;

    const apiRes = await fetch('https://www.googleapis.com/calendar/v3/freeBusy', {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${accessToken}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        timeMin,
        timeMax,
        timeZone: 'Asia/Ho_Chi_Minh',
        items: [{ id: 'primary' }],
      }),
    });

    if (!apiRes.ok) {
      const details = await apiRes.text();
      return Response.json({ error: 'calendar_api_error', details }, { status: 502 });
    }

    const data = await apiRes.json();
    const rawBusy = (data?.calendars?.primary?.busy) || [];

    return Response.json({
      date,
      busy: rawBusy.map((b) => ({ start: b.start, end: b.end })),
    });
  } catch (error) {
    return Response.json({ error: error.message }, { status: 500 });
  }
});