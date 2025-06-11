@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu - Ayam Goreng JOSS</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            :root {
                --primary-color: #FF3D00;
                --primary-dark: #B71C1C;
                --primary-light: #FFAB00;
                --accent-color: #FF6D00;
                --text-dark: #212121;
                --text-light: #FFFFFF;
                --background-light: #FBE9E7;
                --background-dark: #212121;
                --hover-transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                --spicy-gradient: linear-gradient(135deg, #FF3D00, #FF6D00);
                --hot-glow: 0 0 15px rgba(255, 61, 0, 0.7);
                --pepper-border: 2px solid #B71C1C;
                --spicy-highlight: #FFAB00;
                --menu-card-bg: linear-gradient(135deg, #2b0a01, #3d1000);
                --menu-card-border: linear-gradient(45deg, #FF3D00, #FFAB00, #FF3D00);
                --menu-text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                --menu-font-heading: 'Poppins', sans-serif;
                --menu-font-body: 'Poppins', sans-serif;
            }

            body {
                background-color: var(--background-light);
                color: var(--text-dark);
                overflow-x: hidden;
            }

            body::-webkit-scrollbar {
                width: 8px;
            }

            body::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            body::-webkit-scrollbar-thumb {
                background: var(--primary-color);
                border-radius: 10px;
            }

            body::-webkit-scrollbar-thumb:hover {
                background: var(--primary-dark);
            }

            /* Enhanced Menu Hero Section - Spicy Theme */
            .menu-hero {
                position: relative;
                height: 70vh;
                background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('gambar/hero-menu.jpg') }}');
                background-size: cover;
                background-position: center;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                opacity: 0;
                transform: translateY(50px);
                transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                overflow: hidden;
                border-bottom: 3px solid var(--primary-dark);
            }

            .menu-hero:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle, rgba(255,61,0,0.4) 0%, rgba(0,0,0,0) 70%);
                z-index: 1;
                animation: pulse-glow 5s infinite alternate;
                box-shadow: inset 0 0 50px rgba(183, 28, 28, 0.5);
            }

            @keyframes pulse-glow {
                0% {
                    opacity: 0.3;
                    transform: scale(1);
                }
                100% {
                    opacity: 0.7;
                    transform: scale(1.2);
                }
            }

            .menu-hero.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .menu-hero-content {
                position: relative;
                z-index: 2;
                max-width: 800px;
                padding: 0 20px;
            }

            .menu-hero-content h1 {
                font-size: 4rem;
                font-weight: 800;
                margin-bottom: 1.5rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                animation: textPulse 2s infinite alternate;
                letter-spacing: 2px;
                position: relative;
                display: inline-block;
            }

            .menu-hero-content h1:after {
                content: '';
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 2px;
                box-shadow: 0 0 15px var(--primary-color);
            }

            @keyframes textPulse {
                from {
                    text-shadow: 2px 2px 8px rgba(255, 107, 0, 0.6);
                }

                to {
                    text-shadow: 2px 2px 15px rgba(255, 107, 0, 0.9);
                }
            }

            .menu-hero-content p {
                font-size: 1.3rem;
                max-width: 700px;
                margin: 2rem auto 0;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
                line-height: 1.6;
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 1s forwards 0.5s;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero-buttons {
                margin-top: 2.5rem;
                display: flex;
                justify-content: center;
                gap: 20px;
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 1s forwards 1s;
            }

            .hero-button {
                padding: 12px 30px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 1.1rem;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                z-index: 1;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .hero-button:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 0%;
                height: 100%;
                background: rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
                z-index: -1;
            }

            .hero-button:hover:before {
                width: 100%;
            }

            .hero-button.primary {
                background: var(--primary-color);
                color: white;
                border: 2px solid var(--primary-color);
            }

            .hero-button.primary:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            }

            .hero-button.secondary {
                background: transparent;
                color: white;
                border: 2px solid white;
            }

            .hero-button.secondary:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            }

            .floating-elements {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                overflow: hidden;
                z-index: 1;
            }

            .floating-element {
                position: absolute;
                width: 80px;
                height: 80px;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                opacity: 0.7;
                filter: drop-shadow(0 0 10px rgba(255, 107, 0, 0.5));
                z-index: 1;
            }

            .floating-element.chicken {
                background-image: url('{{ asset('gambar/chicken-icon.png') }}');
                animation: float 15s infinite linear;
            }

            .floating-element.spice {
                background-image: url('{{ asset('gambar/spice-icon.png') }}');
                animation: float 20s infinite linear;
            }

            @keyframes float {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                }
                25% {
                    transform: translate(100px, 50px) rotate(90deg);
                }
                50% {
                    transform: translate(200px, 0) rotate(180deg);
                }
                75% {
                    transform: translate(100px, -50px) rotate(270deg);
                }
                100% {
                    transform: translate(0, 0) rotate(360deg);
                }
            }

            /* Category Navigation - Enhanced */
            .category-nav {
                background-color: white;
                padding: 1.2rem 0;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                position: sticky;
                top: 80px;
                z-index: 100;
                border-bottom: 3px solid var(--primary-light);
                transition: all 0.3s ease;
            }

            .category-nav:hover {
                box-shadow: 0 8px 20px rgba(255, 107, 0, 0.15);
            }

            .category-list {
                height: 50px;
                display: flex;
                justify-content: center;
                list-style: none;
                gap: 15px;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding: 0 20px;
                scrollbar-width: thin;
                scrollbar-color: var(--primary-color) #f1f1f1;
                max-width: 1200px;
                margin: 0 auto;
            }

            .category-list::-webkit-scrollbar {
                height: 5px;
            }

            .category-list::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .category-list::-webkit-scrollbar-thumb {
                background: var(--primary-color);
                border-radius: 10px;
            }

            .category-list li {
                flex: 0 0 auto;
                position: relative;
            }

            .category-list li a {
                text-decoration: none;
                color: var(--text-dark);
                font-weight: 600;
                font-size: 1.1rem;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                padding: 10px 18px;
                border-radius: 30px;
                display: block;
                white-space: nowrap;
                background-color: #f9f9f9;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                border: 1px solid transparent;
            }

            .category-list li a:hover,
            .category-list li a.active {
                color: white;
                background-color: var(--primary-color);
                transform: translateY(-5px);
                box-shadow: 0 10px 15px rgba(255, 107, 0, 0.2);
                border-color: var(--primary-light);
            }

            /* Add indicator for active category */
            .category-list li a.active:after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 0;
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-top: 8px solid var(--primary-color);
            }

            /* Add a horizontal scroll indicator */
            .scroll-indicator {
                display: none;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 40px;
                height: 40px;
                background-color: rgba(255, 255, 255, 0.8);
                border-radius: 50%;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                z-index: 10;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .scroll-indicator:hover {
                background-color: var(--primary-color);
                color: white;
                box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
            }

            .scroll-left {
                left: 10px;
            }

            .scroll-right {
                right: 10px;
            }

            /* Enhanced Menu Section */
            .menu-section {
                padding: 70px 5% 80px;
                opacity: 0;
                transform: translateY(50px);
                transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
                position: relative;
                margin-bottom: 20px;
                border-bottom: 1px dashed rgba(183, 28, 28, 0.2);
            }

            .menu-section:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ asset('gambar/pattern-bg.png') }}');
                background-size: 200px;
                background-repeat: repeat;
                opacity: 0.05;
                z-index: -1;
                transition: all 1.5s ease;
            }

            .menu-section:after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at 50% 50%, rgba(255, 61, 0, 0.03) 0%, transparent 70%);
                z-index: -1;
                opacity: 0;
                transition: opacity 1s ease;
            }

            .menu-section:hover:before {
                background-size: 220px;
                opacity: 0.08;
            }

            .menu-section:hover:after {
                opacity: 1;
            }

            .menu-section.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .menu-section:last-child {
                border-bottom: none;
            }

            .category-title {
                font-size: 3rem;
                margin-bottom: 2.5rem;
                color: var(--primary-dark);
                text-align: center;
                position: relative;
                display: inline-block;
                left: 50%;
                transform: translateX(-50%);
                font-weight: 800;
                text-shadow: 2px 2px 4px rgba(255, 61, 0, 0.3);
                padding: 10px 50px;
                background: linear-gradient(45deg, #B71C1C, #FF3D00, #FFAB00);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-size: 200% 200%;
                animation: gradient-shift 5s ease infinite;
                letter-spacing: 1px;
            }

            .category-title::before,
            .category-title::after {
                content: '🔥';
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                font-size: 2rem;
                filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8));
                animation: flame-float 3s infinite alternate;
            }

            .category-title::before {
                left: 0;
                animation-delay: 0s;
            }

            .category-title::after {
                content: '🌶️';
                right: 0;
                animation-delay: 1.5s;
            }

            .category-title-underline {
                position: absolute;
                height: 6px;
                width: 120px;
                background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 3px;
                box-shadow: 0 0 15px rgba(255, 61, 0, 0.6);
                overflow: hidden;
            }

            .category-title-underline::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
                animation: shimmer 3s infinite;
            }

            @keyframes shimmer {
                0% { left: -100%; }
                100% { left: 100%; }
            }

            .category-description {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 50px;
                color: #4d1500;
                line-height: 1.7;
                font-size: 1.15rem;
                font-weight: 500;
                padding: 20px 30px;
                border-radius: 15px;
                background: linear-gradient(135deg, rgba(255, 171, 0, 0.08), rgba(255, 61, 0, 0.08));
                border-left: 3px solid var(--primary-color);
                border-right: 3px solid var(--primary-color);
                position: relative;
                box-shadow: 0 10px 30px rgba(183, 28, 28, 0.1);
                transition: all 0.3s ease;
                backdrop-filter: blur(5px);
                transform: perspective(1000px) rotateX(2deg);
            }

            .category-description:hover {
                transform: perspective(1000px) rotateX(0);
                box-shadow: 0 15px 40px rgba(183, 28, 28, 0.15);
                background: linear-gradient(135deg, rgba(255, 171, 0, 0.12), rgba(255, 61, 0, 0.12));
            }

            .category-description:before,
            .category-description:after {
                content: '❧';
                color: var(--primary-color);
                font-size: 1.8rem;
                position: absolute;
                font-weight: bold;
                opacity: 0.8;
                top: 50%;
                transform: translateY(-50%);
            }

            .category-description:before {
                left: 10px;
            }

            .category-description:after {
                right: 10px;
                transform: translateY(-50%) scaleX(-1);
            }

            .menu-items {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 35px;
                margin-top: 40px;
                position: relative;
                perspective: 1000px;
            }

            @media (min-width: 1200px) {
                .menu-items {
                    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                }
            }

            @media (max-width: 768px) {
                .menu-items {
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 25px;
                }
            }

            /* Enhanced Menu Item - Super Spicy Design */
            .menu-item {
                background: linear-gradient(135deg, #2b0a01, #3d1000);
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 15px 35px rgba(183, 28, 28, 0.25);
                transition: var(--hover-transition);
                opacity: 0;
                transform: translateY(30px);
                position: relative;
                color: white;
                margin-bottom: 10px;
            }

            .menu-item::before {
                content: '';
                position: absolute;
                inset: 0;
                border-radius: 20px;
                padding: 3px;
                background: linear-gradient(45deg, #FF3D00, #FFAB00, #FF3D00);
                background-size: 300% 300%;
                animation: gradient-shift 8s ease infinite;
                -webkit-mask:
                    linear-gradient(#fff 0 0) content-box,
                    linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                pointer-events: none;
                z-index: 2;
                opacity: 0.7;
            }

            .menu-item::after {
                content: '🔥';
                position: absolute;
                top: -12px;
                right: -12px;
                font-size: 28px;
                opacity: 0;
                transform: rotate(15deg) scale(0);
                transition: all 0.4s ease;
                z-index: 5;
                filter: drop-shadow(0 0 8px rgba(255, 61, 0, 0.8));
            }

            .menu-item.visible {
                opacity: 1;
                transform: translateY(0);
                transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .menu-item:hover {
                transform: translateY(-12px) scale(1.03);
                box-shadow: 0 20px 40px rgba(255, 61, 0, 0.3),
                            0 5px 15px rgba(255, 171, 0, 0.3),
                            0 0 30px rgba(255, 61, 0, 0.15);
            }

            .menu-item:hover::before {
                animation: gradient-shift 3s ease infinite;
                opacity: 1;
                padding: 4px;
            }

            .menu-item:hover::after {
                opacity: 1;
                transform: rotate(0deg) scale(1);
                animation: flame-float 2s infinite;
            }

            @keyframes flame-float {
                0%, 100% { transform: translateY(0) rotate(0); }
                50% { transform: translateY(-10px) rotate(15deg); }
            }

            .menu-item-image-container {
                position: relative;
                height: 230px;
                overflow: hidden;
                border-top-left-radius: 18px;
                border-top-right-radius: 18px;
            }

            .menu-item-image {
                height: 100%;
                width: 100%;
                object-fit: cover;
                transition: all 0.5s cubic-bezier(0.215, 0.610, 0.355, 1.000);
                transform-origin: center;
            }

            .menu-item:hover .menu-item-image {
                transform: scale(1.1) rotate(1deg);
                filter: brightness(1.1) contrast(1.05);
            }

            .menu-item-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(180deg,
                    rgba(0,0,0,0) 40%,
                    rgba(183,28,28,0.5) 70%,
                    rgba(183,28,28,0.85) 100%);
                opacity: 0;
                transition: all 0.4s ease;
            }

            .menu-item-overlay::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url("data:image/svg+xml,%3Csvg width='50' height='50' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,171,0,0.2)' fill-opacity='0.3' fill-rule='evenodd'/%3E%3C/svg%3E");
                opacity: 0.3;
            }

            .menu-item:hover .menu-item-overlay {
                opacity: 1;
            }

            .menu-item-quick-view {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.5);
                background: rgba(255, 61, 0, 0.85);
                color: white;
                border: none;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                font-size: 1.4rem;
                opacity: 0;
                transition: all 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6);
                box-shadow: 0 0 0 0 rgba(255, 61, 0, 0.5);
                z-index: 10;
            }

            .menu-item:hover .menu-item-quick-view {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
                animation: pulse-button 2s infinite;
            }

            @keyframes pulse-button {
                0% {
                    box-shadow: 0 0 0 0 rgba(255, 61, 0, 0.7);
                }
                70% {
                    box-shadow: 0 0 0 15px rgba(255, 61, 0, 0);
                }
                100% {
                    box-shadow: 0 0 0 0 rgba(255, 61, 0, 0);
                }
            }

            .menu-item-quick-view:hover {
                background: var(--primary-light);
                transform: translate(-50%, -50%) scale(1.1);
            }

            .menu-item-badge {
                position: absolute;
                top: 15px;
                left: 0;
                background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
                color: white;
                padding: 6px 14px;
                font-size: 0.85rem;
                font-weight: 700;
                border-radius: 0 20px 20px 0;
                box-shadow: 0 5px 15px rgba(183, 28, 28, 0.3);
                z-index: 10;
                opacity: 0.95;
                transform: translateX(-5px);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .menu-item-badge:after {
                content: '';
                position: absolute;
                left: 0;
                bottom: -5px;
                width: 0;
                height: 0;
                border-left: 0 solid transparent;
                border-right: 5px solid transparent;
                border-top: 5px solid #B71C1C;
            }

            .menu-item:nth-child(3n) .menu-item-badge {
                background: linear-gradient(135deg, #FFC107, #FFAB00);
            }

            .menu-item:nth-child(4n) .menu-item-badge {
                background: linear-gradient(135deg, #43A047, #66BB6A);
            }

            .menu-item:hover .menu-item-badge {
                transform: translateX(0);
                opacity: 1;
                box-shadow: 0 5px 15px rgba(183, 28, 28, 0.5);
            }

            .menu-item-content {
                padding: 25px 20px;
                position: relative;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(5px);
                border-bottom-left-radius: 18px;
                border-bottom-right-radius: 18px;
                transition: all 0.3s ease;
            }

            .menu-item:hover .menu-item-content {
                background: rgba(0, 0, 0, 0.5);
                transform: translateY(-5px);
            }

            .menu-item-title {
                font-size: 1.5rem;
                margin-bottom: 12px;
                color: white;
                position: relative;
                display: inline-block;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .menu-item-title:after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
                transition: width 0.4s cubic-bezier(0.22, 0.61, 0.36, 1);
                border-radius: 3px;
                box-shadow: 0 2px 5px rgba(255, 61, 0, 0.3);
            }

            .menu-item:hover .menu-item-title:after {
                width: 100%;
            }

            .menu-item-description {
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 18px;
                line-height: 1.6;
                height: 60px;
                overflow: hidden;
                font-size: 0.95rem;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
                transition: all 0.3s ease;
            }

            .menu-item:hover .menu-item-description {
                color: rgba(255, 255, 255, 0.95);
            }

            .menu-item-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 18px;
                position: relative;
            }

            .menu-item-meta:before {
                content: '';
                position: absolute;
                top: -10px;
                left: -5%;
                width: 110%;
                height: 1px;
                background: linear-gradient(90deg,
                    rgba(255,61,0,0),
                    rgba(255,61,0,0.5),
                    rgba(255,61,0,0));
            }

            .menu-item-price {
                font-size: 1.3rem;
                font-weight: 800;
                color: var(--primary-light);
                display: inline-block;
                padding: 6px 15px 6px 15px;
                background-color: rgba(0, 0, 0, 0.3);
                border-radius: 8px;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                box-shadow: inset 0 0 10px rgba(255, 61, 0, 0.2);
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
                letter-spacing: 0.5px;
                position: relative;
                overflow: hidden;
                border: 1px solid rgba(255, 61, 0, 0.3);
            }

            .menu-item-price:after {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: 0.5s;
            }

            .menu-item:hover .menu-item-price {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                color: white;
                transform: translateY(-3px) scale(1.05);
                box-shadow: 0 5px 15px rgba(255, 61, 0, 0.4);
                border-color: var(--primary-light);
            }

            .menu-item:hover .menu-item-price:after {
                left: 100%;
            }

            .menu-item-rating {
                display: flex;
                align-items: center;
                color: #ffc107;
                font-weight: 600;
                background: rgba(0, 0, 0, 0.3);
                padding: 6px 12px;
                border-radius: 8px;
                transition: all 0.3s ease;
                box-shadow: inset 0 0 10px rgba(255, 171, 0, 0.1);
                border: 1px solid rgba(255, 171, 0, 0.3);
            }

            .menu-item:hover .menu-item-rating {
                background: rgba(0, 0, 0, 0.5);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .menu-item-rating i {
                margin-right: 5px;
                animation: star-pulse 1.5s infinite alternate;
            }

            @keyframes star-pulse {
                0% { transform: scale(1); }
                100% { transform: scale(1.2); }
            }

            .menu-item-button {
                padding: 14px 20px;
                background: linear-gradient(135deg, #FF3D00, #B71C1C);
                color: white;
                border: none;
                border-radius: 12px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                position: relative;
                overflow: hidden;
                z-index: 1;
                width: 100%;
                text-align: center;
                display: block;
                text-decoration: none;
                margin-top: 15px;
                text-transform: uppercase;
                letter-spacing: 1px;
                box-shadow: 0 5px 15px rgba(183, 28, 28, 0.2), inset 0 2px 5px rgba(255, 255, 255, 0.1);
                font-size: 1rem;
                border: 1px solid rgba(255, 61, 0, 0.3);
            }

            .menu-item-button:before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: 0.6s;
                z-index: -1;
            }

            .menu-item-button:hover {
                background: linear-gradient(135deg, #FFAB00, #FF3D00);
                transform: translateY(-5px) scale(1.03);
                box-shadow: 0 10px 25px rgba(183, 28, 28, 0.4), 0 0 20px rgba(255, 61, 0, 0.3);
                letter-spacing: 1.5px;
            }

            .menu-item-button:hover:before {
                left: 100%;
            }

            .menu-item-button:after {
                content: "🌶️";
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
                font-size: 0;
                opacity: 0;
                transition: all 0.4s ease;
            }

            .menu-item:hover .menu-item-button:after {
                font-size: 1.2rem;
                opacity: 1;
                right: 15px;
            }

            .menu-item-button i {
                margin-right: 8px;
                transition: all 0.3s ease;
            }

            .menu-item-button:hover i {
                animation: shake-cart 1s infinite;
            }

            @keyframes shake-cart {
                0% { transform: translateX(0); }
                25% { transform: translateX(-3px); }
                50% { transform: translateX(0); }
                75% { transform: translateX(3px); }
                100% { transform: translateX(0); }
            }

            .menu-item:hover .menu-item-button i {
                transform: scale(1.2);
            }

            /* Enhanced Product Modal */
            .product-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 2000;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.5s cubic-bezier(0.19, 1, 0.22, 1);
                backdrop-filter: blur(5px);
            }

            .product-modal.active {
                opacity: 1;
                pointer-events: all;
                display: flex;
            }

            .modal-content {
                background-color: white;
                border-radius: 15px;
                max-width: 800px;
                width: 90%;
                display: flex;
                flex-direction: column;
                position: relative;
                transform: translateY(50px) scale(0.95);
                opacity: 0;
                transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
                border: 2px solid var(--primary-light);
                overflow: hidden;
                max-height: 90vh;
            }

            .product-modal.active .modal-content {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            .modal-header {
                position: relative;
                height: 250px;
                overflow: hidden;
            }

            .modal-header-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .modal-header-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 20px;
                color: white;
            }

            .modal-header-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 10px;
                text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            }

            .modal-header-meta {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 10px;
            }

            .modal-header-rating {
                display: flex;
                align-items: center;
                color: #ffc107;
            }

            .modal-header-rating i {
                margin-right: 5px;
            }

            .modal-header-category {
                background: rgba(255,255,255,0.2);
                padding: 3px 10px;
                border-radius: 20px;
                font-size: 0.9rem;
            }

            .close-modal {
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                font-size: 1.5rem;
                cursor: pointer;
                color: white;
                transition: all 0.3s ease;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
            }

            .close-modal:hover {
                background-color: white;
                color: var(--primary-color);
                transform: rotate(90deg);
            }

            .modal-body {
                padding: 30px;
                overflow-y: auto;
            }

            .modal-description {
                color: #666;
                margin-bottom: 30px;
                line-height: 1.8;
                font-size: 1.1rem;
            }

            .modal-details {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .modal-detail-item {
                display: flex;
                flex-direction: column;
                background: #f9f9f9;
                padding: 15px;
                border-radius: 10px;
                transition: all 0.3s ease;
            }

            .modal-detail-item:hover {
                background: #fff3e0;
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }

            .modal-detail-label {
                font-size: 0.9rem;
                color: #888;
                margin-bottom: 5px;
            }

            .modal-detail-value {
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--text-dark);
            }

            .modal-price-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 30px;
            }

            .modal-price {
                font-size: 2rem;
                font-weight: 700;
                color: var(--primary-color);
            }

            .modal-quantity {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .quantity-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 2px solid var(--primary-color);
                background: white;
                color: var(--primary-color);
                font-size: 1.2rem;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .quantity-btn:hover {
                background: var(--primary-color);
                color: white;
            }

            .quantity-input {
                width: 50px;
                height: 40px;
                border: 2px solid #ddd;
                border-radius: 8px;
                text-align: center;
                font-size: 1.1rem;
                font-weight: 600;
            }

            .modal-actions {
                display: flex;
                gap: 15px;
            }

            .add-to-cart {
                flex: 1;
                padding: 15px;
                background-color: var(--primary-color);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 1.1rem;
                cursor: pointer;
                transition: var(--hover-transition);
                position: relative;
                overflow: hidden;
                z-index: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .add-to-cart:before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: 0.5s;
                z-index: -1;
            }

            .add-to-cart:hover:before {
                left: 100%;
            }

            .add-to-cart:hover {
                background-color: var(--primary-dark);
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }

            .add-to-wishlist {
                width: 50px;
                height: 50px;
                border-radius: 8px;
                border: 2px solid #ddd;
                background: white;
                color: #666;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .add-to-wishlist:hover {
                border-color: #ff6b6b;
                color: #ff6b6b;
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .add-to-wishlist.active {
                background: #ff6b6b;
                color: white;
                border-color: #ff6b6b;
            }

            /* Footer */
            .footer {
                background-color: var(--background-dark);
                color: white;
                padding: 40px 5% 20px;
                text-align: center;
                opacity: 0;
                transform: translateY(50px);
                transition: all 0.8s ease;
                position: relative;
                overflow: hidden;
            }

            .footer:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ asset('gambar/pattern-dark.png') }}');
                background-size: 200px;
                background-repeat: repeat;
                opacity: 0.05;
                z-index: 0;
            }

            .footer.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .footer-content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                margin-bottom: 30px;
                position: relative;
                z-index: 1;
            }

            .footer-column {
                flex: 1;
                min-width: 200px;
                margin: 10px;
                text-align: left;
            }

            .footer-column h3 {
                font-size: 1.2rem;
                margin-bottom: 20px;
                position: relative;
                padding-bottom: 10px;
                color: var(--primary-light);
            }

            .footer-column h3::after {
                content: '';
                position: absolute;
                height: 2px;
                width: 40px;
                background-color: var(--primary-color);
                bottom: 0;
                left: 0;
            }

            .footer-column p,
            .footer-column a {
                display: block;
                margin-bottom: 10px;
                color: #ddd;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .footer-column a {
                position: relative;
                padding-left: 0;
            }

            .footer-column a:before {
                content: "▸";
                position: absolute;
                left: -15px;
                opacity: 0;
                transition: all 0.3s ease;
                color: var(--primary-color);
            }

            .footer-column a:hover:before {
                left: 0;
                opacity: 1;
            }

            .footer-column a:hover {
                color: var(--primary-light);
                padding-left: 20px;
            }

            .social-icons {
                display: flex;
                gap: 15px;
                margin-top: 15px;
            }

            .social-icons a {
                display: inline-block;
                height: 40px;
                width: 40px;
                background-color: #444;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .social-icons a:after {
                content: "";
                position: absolute;
                height: 100%;
                width: 100%;
                background-color: var(--primary-color);
                border-radius: 50%;
                top: 100%;
                left: 0;
                transition: all 0.3s ease;
                z-index: -1;
            }

            .social-icons a:hover:after {
                top: 0;
            }

            .social-icons a:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            }

            .social-icons a:hover img {
                filter: brightness(1.2);
            }

            .copyright {
                border-top: 1px solid #444;
                padding-top: 20px;
                font-size: 0.9rem;
                color: #999;
                position: relative;
                z-index: 1;
            }

            /* Mobile responsiveness improvements */
            @media screen and (max-width: 992px) {
                .menu-hero-content h1 {
                    font-size: 3rem;
                }

                .modal-content {
                    width: 95%;
                }

                .modal-header {
                    height: 200px;
                }

                .modal-header-title {
                    font-size: 2rem;
                }
            }

            @media screen and (max-width: 768px) {
                .menu-hero {
                    height: 60vh;
                }

                .menu-hero-content h1 {
                    font-size: 2.5rem;
                }

                .menu-hero-content p {
                    font-size: 1.1rem;
                }

                .hero-buttons {
                    flex-direction: column;
                    gap: 15px;
                }

                .category-nav {
                    padding: 1rem 0;
                    top: 60px;
                }

                .category-list {
                    padding: 0 40px;
                }

                .category-list li a {
                    padding: 8px 15px;
                    font-size: 1rem;
                }

                .scroll-indicator {
                    display: flex;
                }

                .modal-header {
                    height: 180px;
                }

                .modal-header-title {
                    font-size: 1.8rem;
                }

                .modal-actions {
                    flex-direction: column;
                }

                .add-to-wishlist {
                    width: 100%;
                    height: 45px;
                }
            }

            /* For extra small screens */
            @media screen and (max-width: 480px) {
                .menu-hero-content h1 {
                    font-size: 2rem;
                }

                .menu-hero-content p {
                    font-size: 1rem;
                }

                .category-list li a {
                    padding: 6px 12px;
                    font-size: 0.9rem;
                }

                .category-title {
                    font-size: 1.8rem;
                }

                .modal-header {
                    height: 150px;
                }

                .modal-header-title {
                    font-size: 1.5rem;
                }

                .modal-body {
                    padding: 20px;
                }

                .modal-price {
                    font-size: 1.5rem;
                }
            }

            /* Animations */
            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            /* Pulse animation for items */
            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* Add a special badge for popular items */
            .menu-item.popular:before {
                content: "Populer!";
                position: absolute;
                top: 10px;
                right: -25px;
                background-color: var(--accent-color);
                color: white;
                padding: 5px 25px;
                transform: rotate(45deg);
                z-index: 5;
                font-size: 0.8rem;
                font-weight: bold;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>

    <body>
        <!-- Enhanced Menu Hero Section -->
        <section class="menu-hero">
            <div class="floating-elements">
                <div class="floating-element chicken" style="top: 20%; left: 10%;"></div>
                <div class="floating-element spice" style="top: 30%; right: 15%;"></div>
                <div class="floating-element chicken" style="bottom: 25%; left: 20%;"></div>
                <div class="floating-element spice" style="bottom: 15%; right: 25%;"></div>
            </div>
            <div class="menu-hero-content">
                <h1>Menu Spesial Kami</h1>
                <p>Nikmati berbagai pilihan ayam goreng lezat dengan resep rahasia dan bumbu pilihan yang dijamin akan
                    memanjakan lidah Anda. Setiap gigitan adalah pengalaman kuliner yang tak terlupakan!</p>
                <div class="hero-buttons">
                    <a href="#menu-categories" class="hero-button primary">Lihat Menu <i class="fas fa-arrow-down"></i></a>
                    <a href="#promo" class="hero-button secondary">Promo Spesial <i class="fas fa-gift"></i></a>
                </div>
            </div>
        </section>

        <!-- Enhanced Category Navigation -->
        <nav class="category-nav" id="menu-categories">
            <div class="scroll-indicator scroll-left"><i class="fas fa-chevron-left"></i></div>
            <ul class="category-list">
                @foreach ($categories as $category)
                    <li><a href="#{{ $category->slug }}"
                            class="{{ request('category') == $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="scroll-indicator scroll-right"><i class="fas fa-chevron-right"></i></div>
        </nav>

        <!-- Enhanced Menu Sections -->
        @foreach ($categories as $category)
            <section id="{{ $category->slug }}" class="menu-section">
                <h2 class="category-title">{{ $category->name }}<span class="category-title-underline"></span></h2>
                <p class="category-description">
                    @if($category->slug == 'ayam-goreng')
                        Ayam goreng spesial kami dimasak dengan resep rahasia turun-temurun dan bumbu pilihan berkualitas tinggi.
                    @elseif($category->slug == 'minuman')
                        Pilihan minuman segar yang cocok untuk menemani hidangan ayam goreng favorit Anda.
                    @elseif($category->slug == 'paket-hemat')
                        Nikmati kombinasi menu favorit dengan harga lebih hemat dan porsi yang mengenyangkan.
                    @else
                        Pilihan menu spesial kami yang diracik dengan bahan-bahan berkualitas dan cita rasa autentik.
                    @endif
                </p>
                <div class="menu-items">
                    @foreach ($menus->where('category_id', $category->id) as $index => $menu)
                        <div class="menu-item {{ $index % 5 == 0 ? 'popular' : '' }}" data-name="{{ $menu->name }}"
                            data-description="{{ $menu->description }}"
                            data-price="Rp {{ number_format($menu->price, 0, ',', '.') }}"
                            data-image="{{ asset($menu->image) }}"
                            data-category="{{ $category->name }}">
                            <div class="menu-item-image-container">
                                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="menu-item-image">
                                <div class="menu-item-overlay"></div>
                                <button class="menu-item-quick-view"><i class="fas fa-eye"></i></button>
                                @if($index % 3 == 0)
                                <div class="menu-item-badge bestseller">🔥 Terlaris</div>
                                @elseif($index % 4 == 0)
                                <div class="menu-item-badge new">✨ Baru</div>
                                @elseif($index % 5 == 0)
                                <div class="menu-item-badge">🌶️ Pedas</div>
                                @endif
                            </div>
                            <div class="menu-item-content">
                                <h3 class="menu-item-title">{{ $menu->name }}</h3>
                                <p class="menu-item-description">{{ $menu->description }}</p>
                                <div class="menu-item-meta">
                                    <div class="menu-item-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                    <div class="menu-item-rating">
                                        <i class="fas fa-star"></i>
                                        {{ number_format(4 + (mt_rand(0, 10) / 10), 1) }}
                                    </div>
                                </div>
                                @if (session()->has('user_id') || session()->has('user_id'))
                                    <form action="{{ url('cart/add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="menu-item-button"><i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang</button>
                                    </form>
                                @else
                                    <a href="{{ url('login') }}" class="menu-item-button"><i class="fas fa-sign-in-alt"></i> Login untuk Menambahkan</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        <!-- Enhanced Product Modal -->
        <div class="product-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="/placeholder.svg" alt="Product Image" class="modal-header-image">
                    <div class="modal-header-overlay">
                        <h2 class="modal-header-title"></h2>
                        <div class="modal-header-meta">
                            <div class="modal-header-rating">
                                <i class="fas fa-star"></i> 4.8
                            </div>
                            <div class="modal-header-category"></div>
                        </div>
                    </div>
                    <button class="close-modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p class="modal-description"></p>
                    <div class="modal-details">
                        <div class="modal-detail-item">
                            <span class="modal-detail-label">Kalori</span>
                            <span class="modal-detail-value">350 kkal</span>
                        </div>
                        <div class="modal-detail-item">
                            <span class="modal-detail-label">Porsi</span>
                            <span class="modal-detail-value">1 orang</span>
                        </div>
                        <div class="modal-detail-item">
                            <span class="modal-detail-label">Waktu Saji</span>
                            <span class="modal-detail-value">10-15 menit</span>
                        </div>
                    </div>
                    <div class="modal-price-container">
                        <div class="modal-price"></div>
                        <div class="modal-quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="number" class="quantity-input" value="1" min="1" max="10">
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang</button>
                        <button class="add-to-wishlist"><i class="far fa-heart"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tentang Kami</h3>
                    <p>Ayam Goreng JOSS menyajikan ayam goreng crispy dengan resep rahasia yang telah turun-temurun sejak tahun 1992.</p>
                    <p>Kami berkomitmen untuk selalu menghadirkan cita rasa autentik dengan bahan-bahan berkualitas tinggi.</p>
                </div>
                <div class="footer-column">
                    <h3>Link Cepat</h3>
                    <a href="/"><i class="fas fa-home"></i> Beranda</a>
                    <a href="/menu"><i class="fas fa-utensils"></i> Menu</a>
                    <a href="#"><i class="fas fa-tag"></i> Promo</a>
                    <a href="#"><i class="fas fa-phone"></i> Kontak</a>
                </div>
                <div class="footer-column">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-envelope"></i> info@ayamgorengjoss.com</p>
                    <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Ayam Goreng No. 123, Jakarta</p>
                    <div class="social-icons">
                        <a href="#"><img src="{{ asset('gambar/facebook-icon.png') }}" alt="Facebook"
                                style="width: 20px;"></a>
                        <a href="#"><img src="{{ asset('gambar/instagram-icon.png') }}" alt="Instagram"
                                style="width: 20px;"></a>
                        <a href="#"><img src="{{ asset('gambar/twitter-icon.png') }}" alt="Twitter"
                                style="width: 20px;"></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                © 2025 Ayam Goreng JOSS. All Rights Reserved.
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elements
                const menuHero = document.querySelector('.menu-hero');
                const categoryLinks = document.querySelectorAll('.category-list a');
                const sections = document.querySelectorAll('.menu-section');
                const categoryNav = document.querySelector('.category-nav');
                const scrollLeftBtn = document.querySelector('.scroll-left');
                const scrollRightBtn = document.querySelector('.scroll-right');
                const categoryList = document.querySelector('.category-list');
                const menuItems = document.querySelectorAll('.menu-item');
                const modal = document.querySelector('.product-modal');
                const modalContent = document.querySelector('.modal-content');
                const modalHeaderImage = document.querySelector('.modal-header-image');
                const modalHeaderTitle = document.querySelector('.modal-header-title');
                const modalHeaderCategory = document.querySelector('.modal-header-category');
                const modalDescription = document.querySelector('.modal-description');
                const modalPrice = document.querySelector('.modal-price');
                const closeModal = document.querySelector('.close-modal');
                const addToCartBtn = document.querySelector('.add-to-cart');
                const addToWishlistBtn = document.querySelector('.add-to-wishlist');
                const quantityInput = document.querySelector('.quantity-input');
                const quantityMinusBtn = document.querySelector('.quantity-btn.minus');
                const quantityPlusBtn = document.querySelector('.quantity-btn.plus');
                const quickViewBtns = document.querySelectorAll('.menu-item-quick-view');

                // Show hero section with animation
                setTimeout(() => {
                    menuHero.classList.add('visible');
                }, 300);

                // Horizontal scrolling for category navigation
                if (scrollLeftBtn && scrollRightBtn) {
                    scrollLeftBtn.addEventListener('click', () => {
                        categoryList.scrollBy({
                            left: -200,
                            behavior: 'smooth'
                        });
                    });

                    scrollRightBtn.addEventListener('click', () => {
                        categoryList.scrollBy({
                            left: 200,
                            behavior: 'smooth'
                        });
                    });
                }

                // Check if scrolling is needed
                function checkScrollIndicators() {
                    if (categoryList.scrollWidth > categoryList.clientWidth) {
                        scrollLeftBtn.style.display = 'flex';
                        scrollRightBtn.style.display = 'flex';
                    } else {
                        scrollLeftBtn.style.display = 'none';
                        scrollRightBtn.style.display = 'none';
                    }
                }

                // Initial check and resize listener
                window.addEventListener('resize', checkScrollIndicators);
                checkScrollIndicators();

                // Center active category on load
                setTimeout(() => {
                    const activeLink = document.querySelector('.category-list a.active');
                    if (activeLink) {
                        activeLink.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest',
                            inline: 'center'
                        });
                    }
                }, 500);

                // Enhanced smooth scroll with active category highlighting
                categoryLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Remove active class from all links
                        categoryLinks.forEach(catLink => {
                            catLink.classList.remove('active');
                        });

                        // Add active class to clicked link
                        this.classList.add('active');

                        // Scroll to target section
                        const targetId = this.getAttribute('href');
                        const targetSection = document.querySelector(targetId);

                        if (targetSection) {
                            // Add highlight effect to target section
                            targetSection.style.transition = 'box-shadow 0.5s ease';
                            targetSection.style.boxShadow = '0 0 25px rgba(255, 107, 0, 0.3)';
                            setTimeout(() => {
                                targetSection.style.boxShadow = 'none';
                            }, 800);

                            // Scroll to section
                            window.scrollTo({
                                top: targetSection.offsetTop - (categoryNav.offsetHeight + 20),
                                behavior: 'smooth'
                            });

                            // Center the active navigation item
                            setTimeout(() => {
                                this.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest',
                                    inline: 'center'
                                });
                            }, 300);
                        }
                    });
                });

                // Update active menu item on scroll
                window.addEventListener('scroll', function() {
                    let currentSectionId = '';
                    const scrollPosition = window.scrollY;

                    // Find current section
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop - (categoryNav.offsetHeight + 100);
                        const sectionHeight = section.offsetHeight;

                        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                            currentSectionId = '#' + section.getAttribute('id');
                        }
                    });

                    // Update active class
                    if (currentSectionId) {
                        categoryLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === currentSectionId) {
                                link.classList.add('active');

                                // Ensure active link is visible in the scrollable container
                                link.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest',
                                    inline: 'center'
                                });
                            }
                        });
                    }
                });

                // Enhanced Scroll Animation with staggered effects
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');

                            // If it's a section with menu items, animate them sequentially
                            if (entry.target.classList.contains('menu-section')) {
                                const items = entry.target.querySelectorAll('.menu-item');
                                items.forEach((item, index) => {
                                    setTimeout(() => {
                                        item.classList.add('visible');
                                    }, 100 * index);
                                });
                            }
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: "0px 0px -100px 0px"
                });

                // Observe all sections and footer
                document.querySelectorAll('.menu-section, .footer').forEach(section => {
                    observer.observe(section);
                });

                // Modal functionality
                function openModal(item) {
                    const name = item.getAttribute('data-name');
                    const description = item.getAttribute('data-description');
                    const price = item.getAttribute('data-price');
                    const image = item.getAttribute('data-image');
                    const category = item.getAttribute('data-category');

                    modalHeaderImage.src = image;
                    modalHeaderTitle.textContent = name;
                    modalHeaderCategory.textContent = category;
                    modalDescription.textContent = description;
                    modalPrice.textContent = price;
                    quantityInput.value = 1;

                    modal.classList.add('active');
                }

                // Open modal when clicking on menu item or quick view button
                menuItems.forEach(item => {
                    const itemImage = item.querySelector('.menu-item-image');
                    const itemTitle = item.querySelector('.menu-item-title');
                    const quickViewBtn = item.querySelector('.menu-item-quick-view');

                    [itemImage, itemTitle, quickViewBtn].forEach(element => {
                        if (element) {
                            element.addEventListener('click', (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                openModal(item);
                            });
                        }
                    });
                });

                // Close modal
                closeModal.addEventListener('click', () => {
                    modal.classList.remove('active');
                });

                // Close modal when clicking outside content
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && modal.classList.contains('active')) {
                        modal.classList.remove('active');
                    }
                });

                // Quantity controls
                quantityMinusBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (value > 1) {
                        quantityInput.value = value - 1;
                    }
                });

                quantityPlusBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (value < 10) {
                        quantityInput.value = value + 1;
                    }
                });

                // Wishlist toggle
                addToWishlistBtn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (this.classList.contains('active')) {
                        this.innerHTML = '<i class="fas fa-heart"></i>';
                    } else {
                        this.innerHTML = '<i class="far fa-heart"></i>';
                    }
                });

                // Add floating animation to some elements
                function addFloatingAnimation() {
                    // Add floating animation to every 4th menu item
                    document.querySelectorAll('.menu-item').forEach((item, index) => {
                        if (index % 4 === 0 && !item.classList.contains('popular')) {
                            item.style.animation = 'float 4s ease-in-out infinite';
                            item.style.animationDelay = (Math.random() * 2) + 's';
                        }
                    });
                }

                // Initialize animations
                addFloatingAnimation();
            });
        </script>
    </body>

    </html>
@endsection

