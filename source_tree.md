
```
tiengviethay/
├── .env.example                # Khai báo DB, Azure API Key, Cloudflare R2 Key, PHPMailer
├── .ftpignore
├── .github/
│   └── workflows/
│       └── deploy.yml           # CI/CD Deploy tự động từ 'main' sang Mắt Bão Production
├── .gitignore                  # Bỏ qua vendor, .env, logs
├── .htaccess                   # Router Rewrite URL về Root
├── index.php                    # Single Entry Point tại Root
├── README.md
├── schema.sql                   # CSDL MySQL gốc + Seed Mockup Data tiếng Hàn/Việt
│
├── app/
│   ├── controllers/            # Controller bóc tách theo từng màn hình SRS
│   │   ├── Admin/              # Dành cho CMS (Mốc 3 & Màn Recommendation CR-01)
│   │   │   └── RecommendationAdminController.php # Màn 14.1 CMS gán ma trận gợi ý
│   │   ├── ApiController.php    # Xử lý các lệnh AJAX (Check session, AJAX Quiz, Update progress)
│   │   ├── AuthController.php   # Module 1: Đăng ký, Đăng nhập, Kick session kép, PHPMailer
│   │   ├── CourseController.php # Module 3: Khóa học, Đề cương, Xem thử, Workspace Lớp học
│   │   ├── CultureController.php# Module 5.5: Blog Văn hóa Việt Nam[cite: 13]
│   │   ├── DashboardController.php # Module 6 & 13.3: Student Dashboard + Khối "Hôm nay nên học"
│   │   ├── ErrorController.php  # Màn phụ: Lỗi 404, Lỗi 500 tiếng Hàn[cite: 13]
│   │   ├── FlashcardController.php # Module 5.1 & 5.2: Flashcard Lật thẻ & Azure TTS Cache[cite: 13]
│   │   ├── HomeController.php   # Module 2.1: Trang chủ tiếng Hàn[cite: 13]
│   │   ├── OnboardingController.php # Module 13.1 & 13.2: Popup Survey & Trang Đề xuất cách học[cite: 14]
│   │   ├── PodcastController.php# Module 5.4: Podcast & Download PDF[cite: 13]
│   │   ├── QuizController.php   # Module 4: Quiz Engine (MCQ, Sắp xếp, Viết lại câu)[cite: 13]
│   │   └── TopicController.php  # Module 5.3: 38 Chủ đề Giao tiếp[cite: 13]
│   │
│   ├── middleware/
│   │   ├── AuthMiddleware.php   # Kiểm tra đăng nhập học viên[cite: 13]
│   │   └── GuestMiddleware.php  # Chặn học viên đã login vào lại trang Login
│   │
│   ├── models/                 # Model tương tác DB MySQL
│   │   ├── ConversationModel.php# Bảng conversations (38 bài giao tiếp)[cite: 13]
│   │   ├── CourseModel.php      # Bảng courses, chapters, lessons (`is_preview`)[cite: 13]
│   │   ├── FlashcardModel.php   # Bảng flashcard_categories, flashcards[cite: 13]
│   │   ├── PodcastModel.php     # Bảng podcasts[cite: 13]
│   │   ├── PostModel.php        # Bảng posts (Văn hóa)[cite: 13]
│   │   ├── QuizModel.php        # Bảng quizzes, questions, answers, user_quiz_results[cite: 13]
│   │   ├── RecommendationModel.php # Bảng recommendations (Ma trận gợi ý CR-01)[cite: 14]
│   │   └── UserModel.php        # Bảng users (`learning_goal`, `current_level`, `current_session`)[cite: 13, 14]
│   │
│   ├── services/               # Tích hợp API bên thứ 3 chuyên biệt
│   │   ├── AzureTTSService.php  # Gọi giọng đọc AI vi-VN-HoaiMyNeural[cite: 13]
│   │   ├── CloudflareR2Service.php # Sinh Presigned URL MP4 tự hủy[cite: 13]
│   │   ├── EmailService.php     # Tích hợp PHPMailer gửi mail kích hoạt[cite: 13]
│   │   └── ValidationService.php# Validate dữ liệu đầu vào[cite: 13]
│   │
│   └── views/                  # View HTML/PHP bóc tách chuẩn theo module
│       ├── _layout/            # Partials Component dùng chung
│       │   ├── breadcrumb.php
│       │   ├── footer.php       # Footer tiếng Hàn & Links Policy tĩnh[cite: 13]
│       │   ├── header.php       # Header Sticky song ngữ `#6a92cd` & `#fad8f2`[cite: 13]
│       │   ├── master.php       # Layout Master chính[cite: 13]
│       │   ├── page-header.php
│       │   ├── course-card.php  # Card Khóa học[cite: 13]
│       │   └── podcast-card.php # Card Podcast[cite: 13]
│       │
│       ├── admin/               # Admin View (Màn CR-01 CMS)
│       │   ├── _layout/
│       │   │   ├── footer.php
│       │   │   ├── header.php
│       │   │   └── sidebar.php
│       │   └── recommendations/ # Màn 14.1 Cấu hình ma trận gợi ý[cite: 14]
│       │       └── index.php
│       │
│       ├── auth/                # Views Module 1
│       │   ├── login.php        # Màn 1.2: Đăng nhập[cite: 13]
│       │   ├── register.php     # Màn 1.1: Đăng ký[cite: 13]
│       │   ├── forgot_password.php # Màn 1.4: Quên mật khẩu[cite: 13]
│       │   ├── reset_password.php  # Màn 1.5: Đặt lại mật khẩu[cite: 13]
│       │   └── session_duplicate_modal.php # Màn 1.3: Popup cảnh báo bị đá thiết bị[cite: 13]
│       │
│       ├── home/                # Views Module 2.1
│       │   ├── banner.php
│       │   ├── features.php
│       │   └── index.php        # Trang chủ tiếng Hàn[cite: 13]
│       │
│       ├── courses/             # Views Module 3
│       │   ├── detail.php       # Màn 3.2: Chi tiết đề cương khóa học[cite: 13]
│       │   ├── index.php        # Màn 3.1: Tab Sơ/Trung/Cao[cite: 13]
│       │   └── workspace.php    # Màn 3.5: Lớp học 2 cột + Player Watermark[cite: 13]
│       │
│       ├── flashcards/          # Views Module 5.1 & 5.2
│       │   ├── index.php        # Màn 5.1: Danh mục chủ đề từ vựng[cite: 13]
│       │   └── study.php        # Màn 5.2: Thẻ Flashcard lật mặt Flip CSS[cite: 13]
│       │
│       ├── topics/              # Views Module 5.3
│       │   └── index.php        # 38 Chủ đề Giao tiếp (bật/tắt dịch, highlight audio)[cite: 13]
│       │
│       ├── podcast/             # Views Module 5.4
│       │   ├── detail.php       # Chi tiết Podcast + Tải PDF[cite: 13]
│       │   └── index.php        # Danh sách Podcast[cite: 13]
│       │
│       ├── quizzes/             # Views Module 4
│       │   ├── index.php        # Màn 4.2: Không gian làm bài (MCQ, Rewriting)[cite: 13]
│       │   └── result.php       # Màn 4.3: Kết quả chấm điểm Tự động[cite: 13]
│       │
│       ├── onboarding/          # Views Phụ lục CR-01 bổ sung
│       │   ├── survey_modal.php # Màn 13.1: Popup Khảo sát 2 câu hỏi[cite: 14]
│       │   └── guide.php        # Màn 13.2: Trang "Đề xuất cách học"[cite: 14]
│       │
│       ├── dashboard/           # Views Module 6 & 13.3
│       │   └── index.php        # Student Dashboard + Khối "Hôm nay nên học"[cite: 13, 14]
│       │
│       ├── culture/             # Views Module 5.5
│       │   ├── detail.php       # Bài viết Văn hóa[cite: 13]
│       │   └── index.php
│       │
│       ├── policies/            # Phân hệ Trang Chính sách Tĩnh Footer[cite: 13]
│       │   ├── privacy.php      # Màn 1.1: Bảo mật[cite: 13]
│       │   ├── terms.php        # Màn 1.2: Điều khoản[cite: 13]
│       │   ├── payment.php      # Màn 1.3: Thanh toán[cite: 13]
│       │   └── refund.php       # Màn 1.4: Hoàn trả[cite: 13]
│       │
│       └── errors/              # Phân hệ Trang Lỗi Hệ thống
│           ├── 404.php          # Màn 2.1: 404 tiếng Hàn[cite: 13]
│           └── 500.php          # Màn 2.2: 500 tiếng Hàn[cite: 13]
│
├── assets/
│   ├── css/                    # File CSS chia nhỏ theo từng Module (đúng style vin-eyewear)
│   │   ├── global.css           # Cấu hình Font Noto Sans CJK KR, dải màu #6a92cd & #fad8f2[cite: 13]
│   │   ├── home.css
│   │   ├── auth.css
│   │   ├── courses.css
│   │   ├── workspace.css        # CSS Custom Video Player & Watermark ngẫu nhiên[cite: 13]
│   │   ├── flashcard.css        # CSS Flip Animation 3D Lật thẻ[cite: 13]
│   │   ├── topics.css           # CSS 38 bài Giao tiếp[cite: 13]
│   │   ├── quiz.css             # CSS Không gian làm bài Quiz[cite: 13]
│   │   ├── onboarding.css       # CSS Popup Survey & Trang Đề xuất CR-01[cite: 14]
│   │   ├── dashboard.css        # CSS Student Dashboard[cite: 13]
│   │   └── errors.css           # CSS Trang 404/500[cite: 13]
│   │
│   ├── js/                     # File JS chia nhỏ theo từng Module
│   │   ├── global.js            # Lập trình AJAX gõ heartbeat check session[cite: 13]
│   │   ├── auth.js
│   │   ├── custom-player.js     # JS Custom Player, Presigned URL & Watermark nhảy vị trí 10-15s[cite: 13]
│   │   ├── flashcard.js         # JS Lật thẻ Flip & Gọi API AJAX phát Azure TTS[cite: 13]
│   │   ├── topics.js            # JS Player Audio 38 bài giao tiếp, highlight câu[cite: 13]
│   │   ├── quiz-engine.js       # JS Thu thập mảng đáp án & Gửi AJAX chấm điểm[cite: 13]
│   │   └── onboarding.js        # JS Xử lý Modal Survey 2 câu hỏi CR-01[cite: 14]
│   │
│   ├── fonts/
│   │   └── NotoSansCJKkr/       # Font mã nguồn mở chuẩn tiếng Hàn[cite: 13]
│   └── images/
│
├── config/
│   ├── app.php
│   ├── database.php             # Thông số kết nối MySQL PDO
│   └── routes.php               # Khai báo Map URL sang Controller/Action[cite: 13]
│
└── core/                       # Bộ Khung Lõi Kế Thừa (Core Framework)[cite: 13]
    ├── App.php                  # Engine Router tự động[cite: 13]
    ├── BaseController.php       # Core Controller
    ├── BaseModel.php            # Core Model PDO
    ├── Database.php             # PDO Connection Singleton
    ├── helpers.php              # Hàm `trim()`, `sanitize()`, `generate_presigned_url()`[cite: 13]
    └── Router.php
```
