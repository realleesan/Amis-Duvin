import { useState } from "react";
import { Moon, Sun } from "lucide-react";

/**
 * ThemeToggle — chuyển Dark / Light mode, lưu vào localStorage.
 * Màu icon tự theo trạng thái cuộn (trắng trên hero, tối khi đã glass).
 */
export default function ThemeToggle({ scrolled = true }) {
  const [dark, setDark] = useState(() =>
    typeof document !== "undefined"
      ? document.documentElement.classList.contains("dark")
      : false
  );

  const toggle = () => {
    const next = !dark;
    setDark(next);
    document.documentElement.classList.toggle("dark", next);
    try {
      localStorage.setItem("adv-theme", next ? "dark" : "light");
    } catch (e) {}
  };

  const color = scrolled ? "text-foreground" : "text-white";

  return (
    <button
      onClick={toggle}
      className={`w-11 h-11 flex items-center justify-center rounded-full transition-colors hover:bg-foreground/5 ${color}`}
      aria-label={dark ? "Chuyển sang giao diện sáng" : "Chuyển sang giao diện tối"}
      title={dark ? "Giao diện sáng" : "Giao diện tối"}
    >
      {dark ? <Sun className="w-5 h-5" /> : <Moon className="w-5 h-5" />}
    </button>
  );
}