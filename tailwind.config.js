/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                tech: "#007BFF",
                gadgets: "#FD7E14",
                robotics: "#AC1754",
                startups: "#FFC107",
                space: "#FFC107",
                biotech: "#FFC107",
                ai: "#6F42C1",
                cybersecurity: "#DC3545",
                science: "#28A745",
                software: "#17A2B8",
                hardware: "#6C757D",
                programming: "#6C757D",
                uiux: "#6C757D",
            },
        },
    },
    plugins: [],
};
