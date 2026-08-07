const db = globalThis.__B44_DB__ || { auth:{ isAuthenticated: async()=>false, me: async()=>null }, entities:new Proxy({}, { get:()=>({ filter:async()=>[], get:async()=>null, create:async()=>({}), update:async()=>({}), delete:async()=>({}) }) }), integrations:{ Core:{ UploadFile:async()=>({ file_url:'' }) } } };

/**
 * ============================================================
 * Mock data cho 8 Workshop — Amis du Vin
 * ============================================================
 * status:
 *   "open" → Còn nhận đăng ký (badge xanh, CTA bật)
 *   "full" → Đã đầy (badge xám, CTA disabled "Đã kín chỗ")
 * slotsLeft: số chỗ còn nhận → dùng cho FOMO ("Chỉ còn X chỗ")
 * minStudents / maxStudents: sĩ số lớp (tối thiểu – tối đa)
 * tuition: học phí dự kiến (500.000 – 2.000.000 VNĐ)
 * img: ảnh đại diện workshop (mặt trước thẻ + banner modal chi tiết)
 * ============================================================
 */
const BASE = "https://media.db.com/images/public/6a623336361c483b3f15558c";

export const WORKSHOPS = [
  {
    id: "ws1",
    no: "01",
    name: "The First Sip",
    date: "Thứ 6, 14/08/2026",
    time: "10h – 12h",
    tuition: "1.000.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 3,
    status: "open",
    img: `${BASE}/2ff99e699_image.png`,
    desc: "Ly vang đầu tiên — khởi đầu hành trình cảm nhận rượu vang: lịch sử, phân loại và bước thử nếm cơ bản dành cho người mới bắt đầu.",
  },
  {
    id: "ws2",
    no: "02",
    name: "The Art of Taste",
    date: "28/08/2026",
    time: "19h – 21h",
    tuition: "1.200.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 5,
    status: "open",
    img: `${BASE}/ef11c3040_image.png`,
    desc: "Khai phá giác quan: kỹ thuật nhìn, ngửi, nếm và cách diễn giải hương vị rượu vang như một chuyên gia thực thụ.",
  },
  {
    id: "ws3",
    no: "03",
    name: "Wine & Food Romance",
    date: "11/09/2026",
    time: "19h – 21h",
    tuition: "1.500.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 2,
    status: "open",
    img: `${BASE}/ff4488a83_image.png`,
    desc: "Nghệ thuật kết hợp rượu vang và ẩm thực — tạo nên những trải nghiệm vị giác hoàn hảo trên bàn tiệc.",
  },
  {
    id: "ws4",
    no: "04",
    name: "Around the Wine World",
    date: "25/09/2026",
    time: "19h – 21h",
    tuition: "1.800.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 0,
    status: "full",
    img: `${BASE}/4e47aee24_image.png`,
    desc: "Hành trình qua các vùng vang danh tiếng thế giới: Bordeaux, Burgundy, Toscana, Napa Valley và nhiều hơn nữa.",
  },
  {
    id: "ws5",
    no: "05",
    name: "Wine & Art",
    date: "09/10/2026",
    time: "19h – 21h",
    tuition: "1.000.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 6,
    status: "open",
    img: `${BASE}/0d495c825_image.png`,
    desc: "Sự giao thoa giữa rượu vang và nghệ thuật — nơi mỗi chai vang là một tác phẩm, mỗi buổi tiệc là một triển lãm.",
  },
  {
    id: "ws6",
    no: "06",
    name: "Wine & Business",
    date: "23/10/2026",
    time: "19h – 21h",
    tuition: "2.000.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 8,
    status: "open",
    img: `${BASE}/f04de475f_image.png`,
    desc: "Rượu vang trong kinh doanh: nghệ thuật chọn vang ngoại giao, kết nối đối tác và phong cách trên bàn thương lượng.",
  },
  {
    id: "ws7",
    no: "07",
    name: "Wine & Fine Living",
    date: "06/11/2026",
    time: "19h – 21h",
    tuition: "1.500.000 VNĐ",
    minStudents: 8,
    maxStudents: 12,
    slotsLeft: 10,
    status: "open",
    img: `${BASE}/2a054bd36_image.png`,
    desc: "Phong cách sống thượng lưu: chọn vang cho hầm riêng, kỹ thuật decant, phục vụ và thưởng thức đỉnh cao.",
  },
  {
    id: "ws8",
    no: "08",
    name: "Amis du Vin Gala",
    date: "20/11/2026",
    time: "18h – 22h",
    tuition: "2.000.000 VNĐ",
    minStudents: 20,
    maxStudents: 40,
    slotsLeft: 15,
    status: "open",
    img: `${BASE}/f807fd6b1_image.png`,
    desc: "Đêm Gala tráng lệ — điểm cao của hành trình, quy tụ cộng đồng Amis du Vin trong một bữa tiệc vang vượt chuẩn.",
  },
];

/** Siêu dữ liệu nhãn trạng thái (badge) theo theme. */
export function statusMeta(status) {
  if (status === "full") {
    return { label: "Đã đầy", cls: "text-muted-foreground border-border bg-muted" };
  }
  return { label: "Còn nhận đăng ký", cls: "text-emerald-600 dark:text-emerald-400 border-emerald-500/30 bg-emerald-500/10" };
}