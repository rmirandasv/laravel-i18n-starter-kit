import i18n from "i18next";
import LanguageDetector from "i18next-browser-languagedetector";
import { initReactI18next } from "react-i18next";
import en from "./locales/en.json";
import es from "./locales/es.json";

const resources = {
  en: { translation: en },
  es: { translation: es },
};

i18n
  .use(LanguageDetector)
  .use(initReactI18next)
  .init({
    resources,
    supportedLngs: ["en", "es"],
    fallbackLng: "en",
    detection: {
      order: ["cookie", "localStorage", "navigator"],
      lookupCookie: "i18nextLng",
      caches: ["cookie", "localStorage"],
      cookieOptions: { path: "/", sameSite: "lax" },
    },
    interpolation: {
      escapeValue: false,
    },
  });

export default i18n;
