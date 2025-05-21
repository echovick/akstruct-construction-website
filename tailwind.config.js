/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#1e3a54",
                    dark: "#0f2133",
                    light: "#315a82",
                },
                secondary: {
                    DEFAULT: "#59c1cc",
                    dark: "#3b9ba5",
                    light: "#8feef9",
                },
                accent: {
                    DEFAULT: "#ffa726",
                    dark: "#e69220",
                    light: "#ffbd5c",
                },
                stone: {
                    DEFAULT: "#f5f5f0",
                    dark: "#e0e0d8",
                },
            },
            fontFamily: {
                sans: ["Poppins", "sans-serif"],
                heading: ["Plus Jakarta Sans", "sans-serif"],
                body: ["Inter", "sans-serif"],
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    sm: "2rem",
                    lg: "4rem",
                    xl: "5rem",
                    "2xl": "6rem",
                },
            },
            borderRadius: {
                xl: "1rem",
                "2xl": "2rem",
            },
            boxShadow: {
                custom: "0 4px 20px -2px rgba(0, 0, 0, 0.1)",
                "custom-lg": "0 10px 30px -3px rgba(0, 0, 0, 0.1)",
                card: "0 4px 20px -2px rgba(0, 0, 0, 0.1)",
                "card-hover": "0 10px 30px -3px rgba(0, 0, 0, 0.1)",
                btn: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)",
                "btn-hover":
                    "0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)",
            },
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
                "gradient-diagonal":
                    "linear-gradient(45deg, var(--tw-gradient-stops))",
            },
            animation: {
                float: "float 6s ease-in-out infinite",
                "slide-up": "slideUp 0.8s ease-out forwards",
                "fade-in": "fadeIn 0.8s ease-out forwards",
            },
            keyframes: {
                float: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-10px)" },
                },
                slideUp: {
                    "0%": { transform: "translateY(20px)", opacity: "0" },
                    "100%": { transform: "translateY(0)", opacity: "1" },
                },
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),
    ],
    safelist: [
        "group",
        "group-hover:opacity-100",
        "group-hover:scale-100",
        "group-hover:translate-y-0",
        "group-hover:translate-x-2",
    ],
};
