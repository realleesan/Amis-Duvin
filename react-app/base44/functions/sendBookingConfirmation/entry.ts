const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

import { createClientFromRequest } from 'npm:@base44/sdk@0.8.40';

const BRAND = 'Amis du Vin';
const HOTLINE = '091 968 65 40';
const CONTACT_EMAIL = 'alexthinh.vn@gmail.com';
const ADDRESS = '58B Võ Văn Dũng, phường Đống Đa, Hà Nội';
const MAP_URL = 'https://maps.app.goo.gl/WxRvYSotAGWVQ81m8';
const SLOGAN = 'Rượu vang & những người bạn';
const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function escapeHtml(s) {
  return String(s == null ? '' : s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

function base64Utf8(str) {
  const bytes = new TextEncoder().encode(str);
  let bin = '';
  for (let i = 0; i < bytes.length; i++) bin += String.fromCharCode(bytes[i]);
  return btoa(bin);
}

function base64UrlUtf8(str) {
  return base64Utf8(str).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
}

function encodeSubject(s) {
  return '=?UTF-8?B?' + base64Utf8(s) + '?=';
}

function shell(innerHtml) {
  return [
    '<!DOCTYPE html>',
    '<html><head><meta charset="UTF-8"></head>',
    '<body style="margin:0;padding:0;background:#f4f4f4;font-family:Georgia,\'Times New Roman\',serif;">',
    '<div style="max-width:600px;margin:0 auto;background:#ffffff;border-top:4px solid #b20225;">',
    innerHtml,
    '</div></body></html>',
  ].join('\r\n');
}

function footerBlock() {
  return [
    '<div style="margin-top:28px;border-top:1px solid #eee;padding-top:18px;">',
    '<p style="font-size:14px;color:#333;margin:0;">Trân trọng,</p>',
    '<p style="font-size:18px;color:#b20225;font-style:italic;margin:6px 0 0;">' + BRAND + '</p>',
    '<p style="font-size:12px;color:#a07f3e;letter-spacing:1px;margin:2px 0 0;">' + escapeHtml(SLOGAN) + '</p>',
    '</div>',
  ].join('\r\n');
}

function workshopHtml(name, wsName, wsDate, wsTime, extras) {
  const inner = [
    '<div style="padding:32px 40px;">',
    '<h1 style="color:#b20225;font-size:22px;letter-spacing:1px;margin:0 0 4px;">' + BRAND + '</h1>',
    '<p style="color:#a07f3e;font-size:12px;letter-spacing:2px;margin:0 0 24px;">' + escapeHtml(SLOGAN) + '</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Kính gửi <strong>' + escapeHtml(name || 'Quý Khách') + '</strong>,</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Amis du Vin xin chân thành cảm ơn Quý Khách đã đăng ký tham dự Workshop "<strong>' + escapeHtml(wsName) + '</strong>".</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Chúng tôi rất hân hạnh được đồng hành cùng Quý Khách trong một buổi gặp gỡ, nơi những câu chuyện về rượu vang, ẩm thực và trải nghiệm thưởng thức sẽ được chia sẻ một cách gần gũi, tinh tế và đầy cảm hứng.</p>',
    '<div style="background:#faf6f0;border-left:3px solid #b20225;padding:18px 22px;margin:24px 0;">',
    '<p style="font-size:12px;letter-spacing:2px;color:#a07f3e;margin:0 0 12px;">THÔNG TIN WORKSHOP</p>',
    '<table style="font-size:14px;color:#333;line-height:1.9;border-collapse:collapse;">',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Workshop</td><td><strong>' + escapeHtml(wsName) + '</strong></td></tr>',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Thời gian</td><td><strong>' + escapeHtml(wsDate || '') + (wsTime ? ' · ' + escapeHtml(wsTime) : '') + '</strong></td></tr>',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Địa điểm</td><td>Nhà hàng ' + BRAND + ' — ' + escapeHtml(ADDRESS) + '</td></tr>',
    '</table>',
    '<p style="margin:12px 0 0;font-size:13px;"><a href="' + MAP_URL + '" style="color:#b20225;text-decoration:none;">Xem bản đồ Google Maps →</a></p>',
    '</div>',
    extras && extras.length
      ? '<div style="background:#f3eef0;border:1px solid #e7d9dd;border-radius:4px;padding:14px 18px;margin:0 0 20px;font-size:13px;color:#555;">Quý Khách cũng đã đặt chỗ thêm: <strong>' + extras.map(escapeHtml).join(', ') + '</strong>. Chúng tôi sẽ gửi thư mời riêng cho từng buổi.</div>'
      : '',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Để buổi Workshop diễn ra thuận lợi, Quý Khách vui lòng có mặt trước giờ bắt đầu khoảng 15 phút để hoàn tất thủ tục đón tiếp.</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Nếu Quý Khách cần hỗ trợ hoặc có thay đổi về lịch tham dự, vui lòng liên hệ với chúng tôi qua:</p>',
    '<p style="font-size:14px;color:#333;line-height:1.9;">Hotline CSKH: <strong>' + HOTLINE + '</strong><br/>Email: <a href="mailto:' + CONTACT_EMAIL + '" style="color:#b20225;text-decoration:none;">' + CONTACT_EMAIL + '</a></p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Một lần nữa, Amis du Vin xin trân trọng cảm ơn sự quan tâm của Quý Khách. Chúng tôi mong sớm được chào đón Quý Khách và cùng nhau tạo nên một trải nghiệm đáng nhớ.</p>',
    footerBlock(),
    '</div>',
  ].join('\r\n');
  return shell(inner);
}

function partyHtml(name, partyDate, slotLabel, participants, notes) {
  const inner = [
    '<div style="padding:32px 40px;">',
    '<h1 style="color:#b20225;font-size:22px;letter-spacing:1px;margin:0 0 4px;">' + BRAND + '</h1>',
    '<p style="color:#a07f3e;font-size:12px;letter-spacing:2px;margin:0 0 24px;">' + escapeHtml(SLOGAN) + '</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Kính gửi <strong>' + escapeHtml(name || 'Quý Khách') + '</strong>,</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Amis du Vin xin chân thành cảm ơn Quý Khách đã đăng ký đặt tiệc riêng tư (Food &amp; Wine Pairing) tại ' + BRAND + '.</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Chúng tôi rất hân hạnh được đồng hành cùng Quý Khách trong một không gian ẩm thực tinh tế, nơi rượu vang và ẩm thực fine dining hòa quyện tạo nên những trải nghiệm đáng nhớ.</p>',
    '<div style="background:#faf6f0;border-left:3px solid #b20225;padding:18px 22px;margin:24px 0;">',
    '<p style="font-size:12px;letter-spacing:2px;color:#a07f3e;margin:0 0 12px;">THÔNG TIN ĐẶT TIỆC</p>',
    '<table style="font-size:14px;color:#333;line-height:1.9;border-collapse:collapse;">',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Ngày</td><td><strong>' + escapeHtml(partyDate || '') + '</strong></td></tr>',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Khung giờ</td><td><strong>' + escapeHtml(slotLabel || '') + '</strong></td></tr>',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Số lượng khách</td><td><strong>' + escapeHtml(String(participants || '')) + '</strong> người</td></tr>',
    '<tr><td style="padding-right:14px;color:#888;vertical-align:top;">Địa điểm</td><td>Nhà hàng ' + BRAND + ' — ' + escapeHtml(ADDRESS) + '</td></tr>',
    '</table>',
    '<p style="margin:12px 0 0;font-size:13px;"><a href="' + MAP_URL + '" style="color:#b20225;text-decoration:none;">Xem bản đồ Google Maps →</a></p>',
    '</div>',
    notes && notes.trim()
      ? '<div style="background:#f3eef0;border:1px solid #e7d9dd;border-radius:4px;padding:14px 18px;margin:0 0 20px;font-size:13px;color:#555;"><span style="color:#888;">Yêu cầu đặc biệt: </span>' + escapeHtml(notes) + '</div>'
      : '',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Bộ phận CSKH sẽ liên hệ với Quý Khách trong vòng 2 giờ làm việc để chốt thực đơn và chi tiết tiệc.</p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Nếu Quý Khách cần hỗ trợ hoặc có thay đổi, vui lòng liên hệ:</p>',
    '<p style="font-size:14px;color:#333;line-height:1.9;">Hotline CSKH: <strong>' + HOTLINE + '</strong><br/>Email: <a href="mailto:' + CONTACT_EMAIL + '" style="color:#b20225;text-decoration:none;">' + CONTACT_EMAIL + '</a></p>',
    '<p style="font-size:14px;color:#333;line-height:1.7;">Một lần nữa, Amis du Vin xin trân trọng cảm ơn sự quan tâm của Quý Khách. Chúng tôi mong sớm được chào đón Quý Khách và cùng nhau tạo nên một trải nghiệm đáng nhớ.</p>',
    footerBlock(),
    '</div>',
  ].join('\r\n');
  return shell(inner);
}

export default async function (req) {
  try {
    const base44 = createClientFromRequest(req);
    const body = await req.json().catch(() => ({}));
    const { type, to, name } = body || {};

    if (!to || !EMAIL_RE.test(String(to))) {
      return Response.json({ error: 'Invalid recipient email' }, { status: 400 });
    }

    let subject;
    let html;
    if (type === 'workshop') {
      subject = 'THƯ MỜI THAM DỰ WORKSHOP ' + (body.workshopName || '') + ' & ' + (body.workshopDate || '');
      html = workshopHtml(name, body.workshopName, body.workshopDate, body.workshopTime, Array.isArray(body.extras) ? body.extras : []);
    } else {
      subject = 'XÁC NHẬN ĐẶT TIỆC RIÊNG TƯ — AMIS DU VIN';
      html = partyHtml(name, body.partyDate, body.slotLabel, body.participants, body.notes);
    }

    const { accessToken } = await db.asServiceRole.connectors.getConnection('gmail');
    if (!accessToken) {
      return Response.json({ error: 'gmail_not_connected' }, { status: 502 });
    }

    const authHeader = { Authorization: 'Bearer ' + accessToken };

    // Lấy email của tài khoản Gmail đã kết nối để đặt tên người gửi.
    let fromHeader = BRAND;
    try {
      const profileRes = await fetch('https://gmail.googleapis.com/gmail/v1/users/me/profile', { headers: authHeader });
      if (profileRes.ok) {
        const profile = await profileRes.json();
        if (profile.emailAddress) fromHeader = BRAND + ' <' + profile.emailAddress + '>';
      }
    } catch (_e) {
      /* dùng mặc định */
    }

    const mime = [
      'From: ' + fromHeader,
      'To: ' + to,
      'Subject: ' + encodeSubject(subject),
      'MIME-Version: 1.0',
      'Content-Type: text/html; charset=UTF-8',
      'Content-Transfer-Encoding: base64',
      '',
      base64Utf8(html),
    ].join('\r\n');

    const sendRes = await fetch('https://gmail.googleapis.com/gmail/v1/users/me/messages/send', {
      method: 'POST',
      headers: { ...authHeader, 'Content-Type': 'application/json' },
      body: JSON.stringify({ raw: base64UrlUtf8(mime) }),
    });

    if (!sendRes.ok) {
      const details = await sendRes.text();
      return Response.json({ error: 'gmail_send_error', details }, { status: 502 });
    }
    const data = await sendRes.json();
    return Response.json({ status: 'sent', messageId: data.id });
  } catch (error) {
    return Response.json({ error: error.message }, { status: 500 });
  }
}