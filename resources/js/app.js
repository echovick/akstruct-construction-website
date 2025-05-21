import Alpine from "alpinejs";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import AOS from "aos";
import Swiper from "swiper";
import {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
    EffectCoverflow,
    Parallax,
} from "swiper/modules";

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialize AOS with enhanced settings
document.addEventListener("DOMContentLoaded", () => {
    AOS.init({
        duration: 800,
        once: false,
        mirror: true,
        offset: 50,
        easing: "ease-in-out-cubic",
        delay: 100,
    });
});

// Make Swiper available globally with additional modules
window.Swiper = Swiper;
window.SwiperModules = {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
    EffectCoverflow,
    Parallax,
};

// Enhanced Hero carousel functionality
document.addEventListener("DOMContentLoaded", () => {
    // Initialize hero carousel
    const heroCarousel = document.querySelector(".hero-carousel");
    if (heroCarousel) {
        const heroSlides = document.querySelectorAll(".hero-slide");
        let currentSlide = 0;

        // Show the first slide initially
        if (heroSlides.length > 0) {
            heroSlides[0].classList.add("opacity-100");
            heroSlides[0].classList.remove("opacity-0");
        }

        // Function to cycle through slides with enhanced transition
        const nextSlide = () => {
            // Hide current slide with a fade out animation
            gsap.to(heroSlides[currentSlide], {
                opacity: 0,
                duration: 1.5,
                ease: "power2.inOut",
            });

            // Update current slide index
            currentSlide = (currentSlide + 1) % heroSlides.length;

            // Show next slide with a fade in and slight scale animation
            gsap.fromTo(
                heroSlides[currentSlide],
                { opacity: 0, scale: 1.05 },
                {
                    opacity: 1,
                    scale: 1,
                    duration: 1.5,
                    ease: "power2.inOut",
                }
            );
        };

        // Set interval for slide transition
        if (heroSlides.length > 1) {
            setInterval(nextSlide, 6000);
        }
    }

    // Enhanced scroll animations using GSAP
    const animateSections = () => {
        // Animate stats counter with improved animation
        const counterElements = document.querySelectorAll("[data-counter]");
        counterElements.forEach((counter) => {
            const target = parseInt(counter.textContent, 10);

            ScrollTrigger.create({
                trigger: counter,
                start: "top 80%",
                onEnter: () => {
                    gsap.from(counter, {
                        textContent: 0,
                        duration: 2,
                        ease: "power2.out",
                        snap: { textContent: 1 },
                        stagger: {
                            each: 0.1,
                            onUpdate: function () {
                                counter.textContent = Math.ceil(
                                    this.targets()[0].textContent
                                );
                            },
                        },
                    });
                },
                once: true,
            });
        });

        // Header parallax effect with enhanced parameters
        const header = document.querySelector(".hero-section");
        if (header) {
            const heroContent = header.querySelector(".container");

            // Background parallax
            gsap.to(header, {
                backgroundPosition: "50% 30%",
                ease: "none",
                scrollTrigger: {
                    trigger: header,
                    start: "top top",
                    end: "bottom top",
                    scrub: true,
                },
            });

            // Fade out content on scroll
            gsap.to(heroContent, {
                opacity: 0.4,
                y: 100,
                ease: "power1.in",
                scrollTrigger: {
                    trigger: header,
                    start: "top top",
                    end: "bottom 20%",
                    scrub: true,
                },
            });
        }

        // Floating badges with random motion
        const floatingElements = document.querySelectorAll(".animate-float");
        floatingElements.forEach((el, index) => {
            gsap.to(el, {
                y: "random(-10, 10)",
                x: "random(-5, 5)",
                rotation: "random(-3, 3)",
                duration: "random(3, 6)",
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true,
                delay: index * 0.2,
            });
        });

        // Animate cards on scroll with staggered effect
        const cardContainers = document.querySelectorAll(".animate-on-scroll");
        cardContainers.forEach((section) => {
            const cards = section.querySelectorAll(
                ".card, .service-card, .project-card"
            );

            if (cards.length > 0) {
                ScrollTrigger.create({
                    trigger: section,
                    start: "top 80%",
                    onEnter: () => {
                        gsap.from(cards, {
                            y: 50,
                            opacity: 0,
                            duration: 0.8,
                            stagger: 0.15,
                            ease: "power2.out",
                        });
                    },
                    once: true,
                });
            }
        });

        // Section title animations
        const sectionTitles = document.querySelectorAll(".section-title");
        sectionTitles.forEach((title) => {
            const heading = title.querySelector("h2");
            const paragraph = title.querySelector("p");

            ScrollTrigger.create({
                trigger: title,
                start: "top 80%",
                onEnter: () => {
                    gsap.from(heading, {
                        y: 30,
                        opacity: 0,
                        duration: 0.8,
                        ease: "back.out(1.5)",
                    });

                    if (paragraph) {
                        gsap.from(paragraph, {
                            y: 30,
                            opacity: 0,
                            duration: 0.8,
                            delay: 0.2,
                            ease: "power2.out",
                        });
                    }
                },
                once: true,
            });
        });
    };

    // Initialize animations
    animateSections();

    // Enhanced mobile menu with slide animation
    const mobileMenuButton = document.querySelector(".mobile-menu-button");
    const mobileMenu = document.querySelector(".mobile-menu");

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    }
});

// Enhanced smooth scrolling for anchor links
document.addEventListener("click", (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const targetId = link.getAttribute("href");
    if (targetId === "#") return;

    const targetElement = document.querySelector(targetId);
    if (!targetElement) return;

    e.preventDefault();

    gsap.to(window, {
        duration: 1,
        scrollTo: {
            y: targetElement,
            offsetY: 100,
        },
        ease: "power3.inOut",
    });
});

// Preloader animation (if preloader exists)
window.addEventListener("load", () => {
    const preloader = document.getElementById("preloader");
    if (preloader) {
        gsap.to(preloader, {
            opacity: 0,
            duration: 0.8,
            ease: "power2.inOut",
            onComplete: () => {
                preloader.style.display = "none";
            },
        });
    }
});
