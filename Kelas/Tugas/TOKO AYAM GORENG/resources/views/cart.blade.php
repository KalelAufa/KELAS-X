@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Ayam Goreng Lezat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #FBE9E7;
            color: #212121;
            overflow-x: hidden;
            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cpath fill='%23ff3d00' fill-opacity='0.05' d='M20 0c.5 0 1 .25 1.25.75s.5 1 .75 1.5c.25.5.5.75 1 .75s1-.25 1.25-.75.5-1 .75-1.5c.25-.5.5-.75 1-.75s1 .25 1.25.75.5 1 .75 1.5c.25.5.5.75 1 .75v1c-.5 0-1-.25-1.25-.75s-.5-1-.75-1.5c-.25-.5-.5-.75-1-.75s-1 .25-1.25.75-.5 1-.75 1.5c-.25.5-.5.75-1 .75s-1-.25-1.25-.75-.5-1-.75-1.5c-.25-.5-.5-.75-1-.75s-1 .25-1.25.75-.5 1-.75 1.5c-.25.5-.5.75-1 .75v-1c.5 0 1-.25 1.25-.75s.5-1 .75-1.5c.25-.5.5-.75 1-.75s1 .25 1.25.75.5 1 .75 1.5c.25.5.5.75 1 .75zM0 20c.5 0 1 .25 1.25.75s.5 1 .75 1.5c.25.5.5.75 1 .75s1-.25 1.25-.75.5-1 .75-1.5c.25-.5.5-.75 1-.75s1 .25 1.25.75.5 1 .75 1.5c.25.5.5.75 1 .75s1-.25 1.25-.75.5-1 .75-1.5c.25-.5.5-.75 1-.75v1c-.5 0-1 .25-1.25.75s-.5 1-.75 1.5c-.25.5-.5.75-1 .75s-1-.25-1.25-.75-.5-1-.75-1.5c-.25-.5-.5-.75-1-.75s-1 .25-1.25.75-.5 1-.75 1.5c-.25.5-.5.75-1 .75s-1-.25-1.25-.75-.5-1-.75-1.5c-.25-.5-.5-.75-1-.75v-1z'/%3E%3C/svg%3E"),
                radial-gradient(circle at top right, rgba(255, 61, 0, 0.1), transparent 70%),
                radial-gradient(circle at bottom left, rgba(255, 171, 0, 0.1), transparent 70%),
                radial-gradient(circle at center, rgba(183, 28, 28, 0.05), transparent 50%);
            animation: bg-pulse 10s ease-in-out infinite;
        }

        @keyframes bg-pulse {
            0%, 100% { background-size: 40px 40px, 120% 120%, 120% 120%, 150% 150%; }
            50% { background-size: 40px 40px, 140% 140%, 140% 140%, 200% 200%; }
        }

        body::-webkit-scrollbar{
            display: none;
        }

        /* Flame design effect for the cart page */
        body:before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(180deg, rgba(255,61,0,0.15) 0%, rgba(255,61,0,0) 100%);
            z-index: -1;
            pointer-events: none;
        }

        /* Hot spots animation */
        body:after {
            content: '';
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: radial-gradient(circle at 20% 80%, rgba(255, 61, 0, 0.1), transparent 15%),
                        radial-gradient(circle at 80% 10%, rgba(255, 171, 0, 0.1), transparent 20%),
                        radial-gradient(circle at 40% 30%, rgba(183, 28, 28, 0.05), transparent 30%),
                        radial-gradient(circle at 70% 60%, rgba(255, 61, 0, 0.07), transparent 25%);
            z-index: -1;
            pointer-events: none;
            animation: hot-spots 20s ease-in-out infinite alternate;
        }

        @keyframes hot-spots {
            0% {
                opacity: 0.5;
                background-position: 0% 0%, 0% 0%, 0% 0%, 0% 0%;
            }
            100% {
                opacity: 1;
                background-position: 10% 20%, -5% 10%, 8% -10%, -15% 5%;
            }
        }

        /* Page entrance animation */
        .cart-section {
            animation: slide-in-from-top 0.7s ease-out;
        }

        @keyframes slide-in-from-top {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-layout {
            animation: fade-in 1s ease-out 0.3s both;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }


        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        /* Cart Section */
        .cart-section {
            padding: 120px 5% 60px;
        }

        .title-wrapper {
            position: relative;
            display: inline-block;
            padding: 0 60px;
            margin-bottom: 40px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 60px;
            padding: 10px 70px;
            box-shadow: 0 10px 25px -10px rgba(183, 28, 28, 0.5);
            transform: perspective(800px) rotateX(5deg);
            transition: all 0.5s ease;
        }

        .title-wrapper:hover {
            transform: perspective(800px) rotateX(0deg);
        }

        .pepper-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FF3D00' d='M273 31c-18 4-32 16-38 32-2 6-2 9-2 17l1 11-22 6c-25 8-68 26-91 40a383 383 0 0 0-121 138c-38 75-38 155 0 207 11 16 28 30 43 38a82 82 0 0 0 37 8c21 0 37-5 53-14-2-1-7-4-12-7-15-11-19-10-18-3 0 8 17 15 37 15a96 96 0 0 0 55-16c9-6 23-21 29-29 36-57 23-142-33-216l-7-9h11c12 1 21 3 34 9 11 5 26 14 34 21a201 201 0 0 1 67 119c1 26-2 44-13 68a145 145 0 0 1-52 65c-26 18-60 28-96 28h-17c-2 4-9 11-17 18-22 19-54 23-91 13-26-7-56-25-73-43-10-11-21-28-21-32 0-2-1-3-3-2s-3 9 1 18a126 126 0 0 0 39 50 177 177 0 0 0 141 29c25-7 46-19 63-36l10-10h7c50 0 93-16 127-48 13-12 17-17 24-30a158 158 0 0 0 29-94c0-67-33-129-97-179-13-10-26-19-28-19-1-1-2-2-1-4 3-5 0-16-6-25a60 60 0 0 0-93-13c-8 7-12 14-15 26-3 9-3 28 0 35 1 3 1 6-3 13-18 35-16 74 7 110 2 3 4 6 3 6l-20-11c-28-16-46-30-69-53-67-68-90-161-58-232 7-16 17-29 32-43 17-16 28-22 47-27l14-3 1 5c3 14 14 30 25 37 13 7 34 10 49 5 15-4 31-17 38-31 4-10 6-24 3-35a68 68 0 0 0-52-48c-11-2-11-2-22-1zm24 14c18 3 33 16 39 33 2 6 2 9 2 19 0 11-1 13-4 20-15 33-62 40-88 14-19-19-18-50 2-70 11-11 21-15 38-17h11z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8));
            animation: hot-pepper 2s infinite;
            z-index: 2;
        }

        .fire-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FFAB00' d='M323 3c-5 5-39 69-39 69-40-42-80-60-81-60-2 1 0 7 28 64 17 33 30 63 30 67a140 140 0 0 1-79 118c-19 9-59 17-88 18-8 0-12 1-20 4-13 5-15 8-6 13 5 2 14 2 36 0 17-2 33-2 36 0 3 1 6 6 7 10 2 7 0 78-3 98-2 12-1 15 1 15 5 0 22-63 27-100 9-64-4-114-39-147 5 1 12 4 16 6 50 27 84 92 90 175l1 13c1 10 19-35 27-68 10-40 9-78-4-115l-3-10 16 15c53 50 82 115 83 184 0 33-2 44-15 79-12 32-30 65-42 75-5 4-5 4-3 5 3 0 18-10 28-21 70-73 82-189 29-282-7-11-30-44-30-42 0 0 11 1 24 1 23 0 24 0 35-5 16-7 30-28 32-47 1-12-3-27-8-27-3 0-20 12-26 18-3 3-11 16-16 29-6 12-11 24-12 26l-1 2v-2c0-1-2-10-3-21-2-15-5-22-18-41-8-12-17-24-18-27-2-6-2-6-4-3zm-66 337c-28 10-55 41-55 63 0 14 5 24 20 37 19 17 24 19 29 8 2-5 1-6-12-20-15-14-17-28-7-42 10-14 31-29 54-38l13-5-14-4c-7-2-19-1-28 1z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8));
            animation: flame-burn 2s infinite alternate;
            z-index: 2;
        }

        .section-title {
            font-size: 3rem;
            margin-bottom: 2.5rem;
            color: #B71C1C;
            position: relative;
            display: inline-block;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            font-weight: 800;
            letter-spacing: 2px;
            padding: 0 10px;
            background: linear-gradient(45deg, #B71C1C, #FF3D00, #FFAB00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Old section-title icons removed as we now use custom pepper and fire icons */

        @keyframes hot-pepper {
            0%, 100% { transform: translateY(-50%) rotate(0deg) scale(1); filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8)); }
            10% { transform: translateY(-60%) rotate(-5deg) scale(1.1); filter: drop-shadow(0 0 15px rgba(255, 61, 0, 0.9)); }
            20% { transform: translateY(-40%) rotate(5deg) scale(0.9); filter: drop-shadow(0 0 8px rgba(255, 61, 0, 0.7)); }
            30% { transform: translateY(-50%) rotate(0deg) scale(1); filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8)); }
            50% { transform: translateY(-45%) rotate(-3deg) scale(1.05); filter: drop-shadow(0 0 12px rgba(255, 61, 0, 0.85)); }
            70% { transform: translateY(-55%) rotate(3deg) scale(0.95); filter: drop-shadow(0 0 9px rgba(255, 61, 0, 0.75)); }
            90% { transform: translateY(-50%) rotate(0deg) scale(1); filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8)); }
        }

        @keyframes flame-burn {
            0% { transform: translateY(-50%) rotate(-5deg) scale(1); filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8)); }
            25% { transform: translateY(-55%) rotate(-2deg) scale(1.2); filter: drop-shadow(0 0 15px rgba(255, 61, 0, 0.9)); }
            50% { transform: translateY(-50%) rotate(3deg) scale(1.25); filter: drop-shadow(0 0 18px rgba(255, 171, 0, 0.95)); }
            75% { transform: translateY(-45%) rotate(-1deg) scale(1.3); filter: drop-shadow(0 0 18px rgba(255, 61, 0, 0.9)); }
            100% { transform: translateY(-50%) rotate(5deg) scale(1.4); filter: drop-shadow(0 0 20px rgba(255, 61, 0, 1)); }
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100%;
            height: 8px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='8' viewBox='0 0 100 8'%3E%3Cpath fill='%23FF3D00' d='M0 8 Q 10 0, 20 4 Q 30 8, 40 2 Q 50 0, 60 6 Q 70 8, 80 4 Q 90 0, 100 8 L 100 8 L 0 8 Z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-size: 100px 8px;
            filter: drop-shadow(0 0 12px rgba(255, 61, 0, 0.6));
            animation: flame-wave 2s linear infinite;
            z-index: 0;
        }

        @keyframes flame-wave {
            0% { background-position: 0 0; }
            100% { background-position: 100px 0; }
        }

        .section-title::before {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100%;
            height: 8px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='8' viewBox='0 0 100 8'%3E%3Cpath fill='%23FFAB00' d='M0 8 Q 10 0, 20 4 Q 30 8, 40 2 Q 50 0, 60 6 Q 70 8, 80 4 Q 90 0, 100 8 L 100 8 L 0 8 Z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-size: 100px 8px;
            filter: drop-shadow(0 0 12px rgba(255, 171, 0, 0.6));
            animation: flame-wave-reverse 3s linear infinite;
            opacity: 0.7;
            z-index: -2;
        }

        @keyframes flame-wave-reverse {
            0% { background-position: 100px 0; }
            100% { background-position: 0 0; }
        }

        .cart-container {
            background: linear-gradient(135deg, #1a0500, #2D0A01);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(183, 28, 28, 0.4);
            padding: 35px;
            margin-bottom: 30px;
            position: relative;
            color: white;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .cart-container:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 20px;
            padding: 4px; /* Controls the border thickness */
            background: linear-gradient(45deg, #FF3D00, #FFAB00, #FF3D00, #FF3D00);
            background-size: 300% 300%;
            animation: gradient-shift 5s ease infinite;
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: 1;
            pointer-events: none;
        }

        .cart-container:hover {
            transform: translateY(-7px);
            box-shadow: 0 30px 60px rgba(183, 28, 28, 0.5);
        }

        .cart-container:hover:before {
            animation: gradient-shift 3s ease infinite;
            background-size: 200% 200%;
            padding: 5px; /* Makes border thicker on hover */
        }

        .cart-container:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h1v1H0V0zm3 3h1v1H3V3zm5 0h1v1H8V3zm3 0h1v1h-1V3zM0 6h1v1H0V6zm3 0h1v1H3V6zm5 0h1v1H8V6zm3 0h1v1h-1V6zM0 9h1v1H0V9zm3 0h1v1H3V9zm5 0h1v1H8V9zm3 0h1v1h-1V9zM0 12h1v1H0v-1zm3 0h1v1H3v-1zm5 0h1v1H8v-1zm3 0h1v1h-1v-1zm-8 3h1v1H3v-1zm5 0h1v1H8v-1zm3 0h1v1h-1v-1z' fill='rgba(255,61,0,0.15)' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.25;
            z-index: 0;
            animation: pattern-move 20s linear infinite;
        }

        @keyframes pattern-move {
            0% { background-position: 0 0; }
            100% { background-position: 100px 100px; }
        }

        .cart-container:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to right, #FF3D00, #FFAB00);
            box-shadow: 0 0 20px 4px rgba(255, 61, 0, 0.7);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            0% { opacity: 0.7; box-shadow: 0 0 20px 4px rgba(255, 61, 0, 0.7); }
            100% { opacity: 1; box-shadow: 0 0 30px 6px rgba(255, 61, 0, 0.9); }
        }

        .cart-empty {
            text-align: center;
            padding: 80px 0;
            position: relative;
            z-index: 1;
            animation: fade-in 0.8s ease-out;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .cart-empty h3 {
            font-size: 2rem;
            margin-bottom: 40px;
            color: #FFAB00;
            text-shadow: 0 0 15px rgba(255, 61, 0, 0.3);
            font-weight: 800;
            letter-spacing: 2px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .cart-empty h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #FF3D00, #FFAB00);
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(255, 61, 0, 0.4);
        }

        .cart-empty:before {
            content: '🍗';
            font-size: 5rem;
            display: block;
            margin-bottom: 20px;
            animation: spin-slow 6s linear infinite, float 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(255, 61, 0, 0.6));
        }

        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }

        .cart-empty .btn {
            display: inline-block;
            padding: 18px 40px;
            background: linear-gradient(135deg, #FF3D00, #B71C1C);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(183, 28, 28, 0.3);
            border: none;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .cart-empty .btn:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='10' viewBox='0 0 100 10'%3E%3Cpath fill='%23ff3d00' d='M0 10 Q 5 0, 10 7 Q 15 0, 20 6 Q 25 0, 30 8 Q 35 0, 40 5 Q 45 0, 50 9 Q 55 0, 60 6 Q 65 0, 70 7 Q 75 0, 80 8 Q 85 0, 90 5 Q 95 0, 100 10 Z'/%3E%3C/svg%3E");
            background-size: 100px 10px;
            background-repeat: repeat-x;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .cart-empty .btn:hover {
            background: linear-gradient(135deg, #B71C1C, #FF3D00);
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(183, 28, 28, 0.4);
            letter-spacing: 2px;
        }

        .cart-empty .btn:hover:after {
            opacity: 1;
            bottom: -5px;
            animation: flame-animation 0.8s infinite linear;
        }

        @keyframes flame-animation {
            0% { background-position: 0px 0px; }
            100% { background-position: 100px 0px; }
        }

        .cart-header {
            display: grid;
            grid-template-columns: 100px 2fr 1fr 1fr 1fr 50px;
            gap: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-weight: 700;
            color: #FFAB00;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
            position: relative;
            margin-bottom: 15px;
        }

        .cart-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(to right, rgba(255,255,255,0.2), transparent);
        }

        .cart-header div {
            text-align: center;
            position: relative;
            padding: 5px 0;
        }

        .cart-header div:nth-child(2) {
            text-align: left;
        }

        .cart-header div:after {
            content: '';
            position: absolute;
            bottom: -16px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #FF3D00;
            transition: width 0.3s ease;
        }

        .cart-header:hover div:after {
            width: 30px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 2fr 1fr 1fr 1fr 50px;
            gap: 20px;
            padding: 25px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cart-item:hover {
            background: linear-gradient(90deg, rgba(255, 61, 0, 0.05), transparent);
            transform: translateX(5px);
        }

        .cart-item:hover:before {
            opacity: 1;
        }

        .cart-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 70%;
            background: linear-gradient(to bottom, #FF3D00, #FFAB00);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 0 3px 3px 0;
            box-shadow: 0 0 10px rgba(255, 61, 0, 0.5);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-image {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 61, 0, 0.3);
        }

        .cart-item:hover .cart-item-image {
            transform: scale(1.1) rotate(3deg);
            box-shadow: 0 8px 20px rgba(255, 61, 0, 0.4);
        }

        .cart-item-details h3 {
            font-size: 1.3rem;
            margin-bottom: 8px;
            font-weight: 700;
            color: #FFAB00;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .cart-item-details p {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.4;
        }

        .cart-item-price, .cart-item-subtotal {
            font-weight: 700;
            font-size: 1.1rem;
            color: #FFAB00;
            text-align: center;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .cart-item:hover .cart-item-price,
        .cart-item:hover .cart-item-subtotal {
            color: #FF3D00;
            transform: scale(1.1);
        }

        /* Updated quantity control styles for perfect horizontal alignment */
        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .quantity-control form {
            display: flex;
            align-items: center;
            background: linear-gradient(to bottom, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            padding: 5px 10px;
            border-radius: 25px;
            position: relative;
            z-index: 1;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .quantity-control form:hover {
            box-shadow: 0 5px 15px rgba(255, 61, 0, 0.2);
        }

        /* Fire effect behind quantity control on hover */
        .quantity-control form:before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='10' viewBox='0 0 60 10'%3E%3Cpath fill='rgba(255, 61, 0, 0.3)' d='M0 10 Q 10 0, 20 5 Q 30 0, 40 7 Q 50 0, 60 10 Z'/%3E%3C/svg%3E") repeat-x;
            background-size: 60px 10px;
            border-radius: 30px;
            z-index: -1;
            opacity: 0;
            transform: translateY(5px);
            transition: all 0.4s ease;
            animation: flame-dance 1s infinite alternate;
        }

        .quantity-control form:hover:before {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes flame-dance {
            0% { background-position: 0px 0px; }
            100% { background-position: 60px 0px; }
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            border: 1px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            font-size: 18px;
            color: #B71C1C;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .quantity-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255, 61, 0, 0.3) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quantity-btn:hover {
            background: linear-gradient(135deg, #FF3D00, #B71C1C);
            color: white;
            border-color: #B71C1C;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(183, 28, 28, 0.3);
        }

        .quantity-btn:hover:before {
            opacity: 1;
        }

        .btn-active {
            background: linear-gradient(135deg, #FF3D00, #B71C1C);
            color: white;
            border-color: #B71C1C;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(183, 28, 28, 0.3);
        }

        /* Loading spinner animation */
        .loading-spinner {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-spinner-large {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            margin-right: 8px;
            vertical-align: middle;
        }

        .btn-loading {
            opacity: 0.8;
            cursor: wait !important;
        }

        .quantity-input {
            width: 45px;
            height: 35px;
            margin: 0 8px;
            text-align: center;
            border: 1px solid #FF3D00;
            border-radius: 5px;
            font-weight: 700;
            color: #B71C1C;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .quantity-input:focus {
            outline: none;
            border-color: #B71C1C;
            box-shadow: 0 0 0 2px rgba(183, 28, 28, 0.2);
            background-color: white;
        }

        /* Remove number input arrows */
        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input {
            -moz-appearance: textfield;
        }

        /* Pulsating animation for focused input */
        .quantity-input:focus {
            animation: pulse-border 1.5s infinite;
        }

        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(255, 61, 0, 0.4); }
            70% { box-shadow: 0 0 0 5px rgba(255, 61, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 61, 0, 0); }
        }

        .remove-item {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .remove-item:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 61, 0, 0.2);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.3s ease;
        }

        .remove-item:hover {
            color: #FF3D00;
            transform: rotate(90deg);
        }

        .remove-item:hover:before {
            transform: scale(1);
        }

        .cart-summary {
            background: linear-gradient(135deg, #1a0500, #2D0A01);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(183, 28, 28, 0.3);
            padding: 35px;
            position: relative;
            overflow: hidden;
            color: white;
            animation: pulse-border 3s infinite;
        }

        @keyframes pulse-border {
            0%, 100% { box-shadow: 0 15px 30px rgba(183, 28, 28, 0.3); }
            50% { box-shadow: 0 15px 40px rgba(255, 61, 0, 0.5); }
        }

        .cart-summary:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 20px;
            padding: 4px; /* Controls the border thickness */
            background: linear-gradient(45deg, #FFAB00, #FF3D00, #FFAB00, #FF3D00);
            background-size: 300% 300%;
            animation: gradient-shift 8s ease infinite;
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: 1;
            pointer-events: none;
        }

        .cart-summary:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #FFAB00, #FF3D00);
            box-shadow: 0 0 15px 2px rgba(255, 61, 0, 0.6);
            z-index: 2;
        }

        .summary-title {
            font-size: 1.7rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #FFAB00;
            font-weight: 700;
            position: relative;
            display: inline-block;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .summary-title:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 70%;
            height: 2px;
            background: linear-gradient(to right, #FF3D00, transparent);
            border-radius: 2px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 18px;
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .summary-row:hover {
            transform: translateX(5px);
            color: #FFAB00;
        }

        .summary-label {
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .summary-row:hover .summary-label {
            color: #FFAB00;
        }

        .summary-value {
            font-weight: 700;
            color: white;
            transition: all 0.3s ease;
        }

        .summary-row:hover .summary-value {
            color: #FF3D00;
        }

        .summary-total {
            font-size: 1.4rem;
            font-weight: 800;
            color: #FF3D00;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background: linear-gradient(135deg, #FF3D00, #B71C1C);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #B71C1C, #FF3D00);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 61, 0, 0.3);
        }

        .checkout-btn:before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='10' viewBox='0 0 100 10'%3E%3Cpath fill='%23ff3d00' d='M0 10 Q 5 0, 10 7 Q 15 0, 20 6 Q 25 0, 30 8 Q 35 0, 40 5 Q 45 0, 50 9 Q 55 0, 60 6 Q 65 0, 70 7 Q 75 0, 80 8 Q 85 0, 90 5 Q 95 0, 100 10 Z'/%3E%3C/svg%3E");
            background-size: 100px 10px;
            background-repeat: repeat-x;
            animation: flame-animation 0.8s infinite linear;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .checkout-btn:hover:before {
            opacity: 1;
            bottom: -5px;
        }

        @keyframes flame-animation {
            0% { background-position: 0px 0px; }
            100% { background-position: 100px 0px; }
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        /* Address Form Styles */
        .address-form {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.95rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #e65100;
            outline: none;
        }

        .address-toggle {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .address-toggle input {
            margin-right: 10px;
        }

        .saved-addresses {
            margin-bottom: 20px;
        }

        .address-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-card:hover {
            border-color: #e65100;
            background-color: #fff9f5;
        }

        .address-card.selected {
            border-color: #e65100;
            background-color: #fff9f5;
            box-shadow: 0 2px 8px rgba(230, 81, 0, 0.1);
        }

        .address-card-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .address-card-title {
            font-weight: 600;
            color: #333;
        }

        .address-card-default {
            font-size: 0.8rem;
            background-color: #e65100;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
        }

        .address-card-content p {
            margin: 5px 0;
            color: #666;
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 40px 5% 20px;
            text-align: center;
            margin-top: 60px;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
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
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            height: 2px;
            width: 40px;
            background-color: #e65100;
            bottom: 0;
            left: 0;
        }

        .footer-column p, .footer-column a {
            display: block;
            margin-bottom: 10px;
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-column a:hover {
            color: #e65100;
            padding-left: 5px;
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
        }

        .social-icons a:hover {
            background-color: #e65100;
            transform: translateY(-5px);
        }

        .copyright {
            border-top: 1px solid #444;
            padding-top: 20px;
            font-size: 0.9rem;
            color: #999;
        }

        @media screen and (max-width: 968px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 1rem 4%;
            }

            .logo h1 {
                font-size: 1.2rem;
            }

            .nav-links {
                position: fixed;
                top: 80px;
                right: -100%;
                background-color: white;
                width: 70%;
                height: calc(100vh - 80px);
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                transition: all 0.5s ease;
                box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links li {
                margin: 1.5rem 0;
            }

            .menu-toggle {
                display: block;
            }

            .cart-header {
                display: none;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
                padding: 15px 0;
                position: relative;
            }

            .cart-item-details {
                grid-column: 2;
            }

            .cart-item-price, .cart-item-subtotal {
                text-align: left;
                margin-top: 5px;
            }

            .quantity-control {
                justify-content: flex-start;
                margin: 10px 0;
            }

            .remove-item {
                position: absolute;
                top: 15px;
                right: 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        .pepper-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FF3D00' d='M273 31c-18 4-32 16-38 32-2 6-2 9-2 17l1 11-22 6c-25 8-68 26-91 40a383 383 0 0 0-121 138c-38 75-38 155 0 207 11 16 28 30 43 38a82 82 0 0 0 37 8c21 0 37-5 53-14-2-1-7-4-12-7-15-11-19-10-18-3 0 8 17 15 37 15a96 96 0 0 0 55-16c9-6 23-21 29-29 36-57 23-142-33-216l-7-9h11c12 1 21 3 34 9 11 5 26 14 34 21a201 201 0 0 1 67 119c1 26-2 44-13 68a145 145 0 0 1-52 65c-26 18-60 28-96 28h-17c-2 4-9 11-17 18-22 19-54 23-91 13-26-7-56-25-73-43-10-11-21-28-21-32 0-2-1-3-3-2s-3 9 1 18a126 126 0 0 0 39 50 177 177 0 0 0 141 29c25-7 46-19 63-36l10-10h7c50 0 93-16 127-48 13-12 17-17 24-30a158 158 0 0 0 29-94c0-67-33-129-97-179-13-10-26-19-28-19-1-1-2-2-1-4 3-5 0-16-6-25a60 60 0 0 0-93-13c-8 7-12 14-15 26-3 9-3 28 0 35 1 3 1 6-3 13-18 35-16 74 7 110 2 3 4 6 3 6l-20-11c-28-16-46-30-69-53-67-68-90-161-58-232 7-16 17-29 32-43 17-16 28-22 47-27l14-3 1 5c3 14 14 30 25 37 13 7 34 10 49 5 15-4 31-17 38-31 4-10 6-24 3-35a68 68 0 0 0-52-48c-11-2-11-2-22-1zm24 14c18 3 33 16 39 33 2 6 2 9 2 19 0 11-1 13-4 20-15 33-62 40-88 14-19-19-18-50 2-70 11-11 21-15 38-17h11z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8));
            animation: hot-pepper 2s infinite;
            z-index: 2;
        }

        .fire-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FFAB00' d='M323 3c-5 5-39 69-39 69-40-42-80-60-81-60-2 1 0 7 28 64 17 33 30 63 30 67a140 140 0 0 1-79 118c-19 9-59 17-88 18-8 0-12 1-20 4-13 5-15 8-6 13 5 2 14 2 36 0 17-2 33-2 36 0 3 1 6 6 7 10 2 7 0 78-3 98-2 12-1 15 1 15 5 0 22-63 27-100 9-64-4-114-39-147 5 1 12 4 16 6 50 27 84 92 90 175l1 13c1 10 19-35 27-68 10-40 9-78-4-115l-3-10 16 15c53 50 82 115 83 184 0 33-2 44-15 79-12 32-30 65-42 75-5 4-5 4-3 5 3 0 18-10 28-21 70-73 82-189 29-282-7-11-30-44-30-42 0 0 11 1 24 1 23 0 24 0 35-5 16-7 30-28 32-47 1-12-3-27-8-27-3 0-20 12-26 18-3 3-11 16-16 29-6 12-11 24-12 26l-1 2v-2c0-1-2-10-3-21-2-15-5-22-18-41-8-12-17-24-18-27-2-6-2-6-4-3zm-66 337c-28 10-55 41-55 63 0 14 5 24 20 37 19 17 24 19 29 8 2-5 1-6-12-20-15-14-17-28-7-42 10-14 31-29 54-38l13-5-14-4c-7-2-19-1-28 1z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            filter: drop-shadow(0 0 10px rgba(255, 61, 0, 0.8));
            animation: flame-burn 2s infinite alternate;
            z-index: 2;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="title-wrapper">
            <div class="pepper-icon"></div>
            <h2 class="section-title">Keranjang Belanja</h2>
            <div class="fire-icon"></div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="background: linear-gradient(135deg, #43A047, #2E7D32); color: white; padding: 18px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3); border-left: 5px solid #1B5E20; animation: slide-in 0.5s ease-out; position: relative; overflow: hidden;">
                <span style="font-weight: 600; display: flex; align-items: center;">
                    <span style="background-color: rgba(255,255,255,0.2); border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">✓</span>
                    {{ session('success') }}
                </span>
                <div style="position: absolute; top: 0; left: 0; height: 100%; width: 5px; background: rgba(255,255,255,0.3);"></div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="background: linear-gradient(135deg, #E53935, #B71C1C); color: white; padding: 18px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 5px 15px rgba(183, 28, 28, 0.3); border-left: 5px solid #7F0000; animation: slide-in 0.5s ease-out; position: relative; overflow: hidden;">
                <span style="font-weight: 600; display: flex; align-items: center;">
                    <span style="background-color: rgba(255,255,255,0.2); border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">✗</span>
                    {{ session('error') }}
                </span>
                <div style="position: absolute; top: 0; left: 0; height: 100%; width: 5px; background: rgba(255,255,255,0.3);"></div>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info" style="background: linear-gradient(135deg, #039BE5, #0277BD); color: white; padding: 18px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 5px 15px rgba(2, 119, 189, 0.3); border-left: 5px solid #01579B; animation: slide-in 0.5s ease-out; position: relative; overflow: hidden;">
                <span style="font-weight: 600; display: flex; align-items: center;">
                    <span style="background-color: rgba(255,255,255,0.2); border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">i</span>
                    {{ session('info') }}
                </span>
                <div style="position: absolute; top: 0; left: 0; height: 100%; width: 5px; background: rgba(255,255,255,0.3);"></div>
            </div>
        @endif

        <style>
            @keyframes slide-in {
                from { transform: translateY(-20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
        </style>

        <div class="cart-layout">
            <div class="cart-container">
                @if ($cartItems->isEmpty())
                    <div class="cart-empty">
                        <h3>Keranjang belanja Anda masih kosong</h3>
                        <a href="{{ url('menu') }}" class="btn">Lihat Menu</a>
                    </div>
                @else
                    <div class="cart-header">
                        <div>Gambar</div>
                        <div>Produk</div>
                        <div>Harga</div>
                        <div>Jumlah</div>
                        <div>Total</div>
                        <div></div>
                    </div>
                    @foreach ($cartItems as $item)
                        <div class="cart-item">
                            <img src="{{ asset($item->menu->image) }}" alt="{{ $item->menu->name }}" class="cart-item-image">
                            <div class="cart-item-details">
                                <h3>{{ $item->menu->name }}</h3>
                                <p>{{ $item->menu->description }}</p>
                            </div>
                            <div class="cart-item-price">Rp {{ number_format($item->menu->price, 0, ',', '.') }}</div>
                            <div class="quantity-control">
                                <form action="{{ url('cart/update') }}" method="POST" id="updateForm{{ $item->id }}">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                    <button type="button" class="quantity-btn decrease-btn" onclick="decreaseQuantity({{ $item->id }})">−</button>
                                    <input type="number" name="quantity" class="quantity-input" value="{{ $item->quantity }}" min="1"
                                           onchange="document.getElementById('updateForm{{ $item->id }}').submit()">
                                    <button type="button" class="quantity-btn increase-btn" onclick="increaseQuantity({{ $item->id }})">+</button>
                                </form>
                            </div>
                            <div class="cart-item-subtotal">Rp {{ number_format($item->menu->price * $item->quantity, 0, ',', '.') }}</div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-item">×</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
            @unless ($cartItems->isEmpty())
            <div class="cart-summary">
                <h3 class="summary-title">Ringkasan Pesanan</h3>
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">Rp {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity), 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Biaya Pengiriman</span>
                    <span class="summary-value">Rp 10.000</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Pajak (10%)</span>
                    <span class="summary-value">Rp {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity) * 0.1, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity) + 10000 + ($cartItems->sum(fn($item) => $item->menu->price * $item->quantity) * 0.1), 0, ',', '.') }}</span>
                </div>

                <!-- Address Section -->
                <div class="address-form">
                    <h3 class="summary-title">Alamat Pengiriman</h3>

                    @if(auth()->check())
                        <!-- Toggle between saved and new address -->
                        <div class="address-toggle">
                            <input type="radio" id="use-saved-address" name="address-type" value="saved" checked>
                            <label for="use-saved-address">Gunakan alamat tersimpan</label>
                        </div>
                        <div class="address-toggle">
                            <input type="radio" id="use-new-address" name="address-type" value="new">
                            <label for="use-new-address">Gunakan alamat baru</label>
                        </div>

                        <!-- Saved Addresses Section -->
                        <div id="saved-addresses-section" class="saved-addresses">
                            @if(isset($addresses) && count($addresses) > 0)
                                @foreach($addresses as $address)
                                    <div class="address-card @if($address->is_default) selected @endif" data-address-id="{{ $address->id }}">
                                        <div class="address-card-header">
                                            <span class="address-card-title">{{ $address->name }}</span>
                                            @if($address->is_default)
                                                <span class="address-card-default">Utama</span>
                                            @endif
                                        </div>
                                        <div class="address-card-content">
                                            <p>{{ $address->recipient_name }}</p>
                                            <p>{{ $address->phone }}</p>
                                            <p>{{ $address->address }}, {{ $address->city }}</p>
                                            <p>{{ $address->postal_code }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Anda belum memiliki alamat tersimpan. Silakan tambahkan alamat baru.</p>
                            @endif
                        </div>
                    @else
                        <div class="login-prompt" style="text-align: center; margin: 20px 0; padding: 20px; border: 1px dashed #FF3D00; border-radius: 5px;">
                            <p style="margin-bottom: 15px;">Untuk melanjutkan checkout, silakan login terlebih dahulu</p>
                            <a href="{{ url('login') }}" style="display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, #FF3D00, #B71C1C); color: white; text-decoration: none; border-radius: 5px; font-weight: 600; transition: all 0.3s ease;">Login Sekarang</a>
                        </div>
                    @endif

                    <!-- New Address Form -->
                    <div id="new-address-form" style="display: none;">
                        <form id="address-form" action="{{ route('alamat.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="address-name">Nama Alamat</label>
                                <input type="text" id="address-name" name="address_name" class="form-control" placeholder="Contoh: Rumah, Kantor">
                            </div>

                            <div class="form-group">
                                <label for="recipient-name">Nama Penerima</label>
                                <input type="text" id="recipient-name" name="recipient_name" class="form-control" placeholder="Nama lengkap penerima">
                            </div>

                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Nomor telepon penerima">
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat Lengkap</label>
                                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">Kota</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Kota">
                                </div>

                                <div class="form-group">
                                    <label for="postal-code">Kode Pos</label>
                                    <input type="text" id="postal-code" name="postal_code" class="form-control" placeholder="Kode pos">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Catatan (opsional)</label>
                                <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Catatan untuk pengiriman"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="save_address" value="1" class="checkout-btn" style="margin-bottom: 10px;">Simpan alamat ini untuk penggunaan berikutnya</button>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="set_as_default" value="1" class="checkout-btn">Jadikan sebagai alamat utama</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="{{ url('cart/checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" id="selected-address-id" name="address_id" value="">
                    <button type="submit" class="checkout-btn" @if(!auth()->check()) onclick="window.location.href='{{ url('login') }}'; return false;" @endif>
                        @if(auth()->check())
                            Lanjut ke Pembayaran
                        @else
                            Login untuk Checkout
                        @endif
                    </button>
                </form>
            </div>
            @endunless
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Ayam Goreng Lezat</h3>
                <p>Menyajikan ayam goreng berkualitas dengan resep rahasia turun temurun sejak 2005.</p>
                <div class="social-icons">
                    <a href="#"><span>FB</span></a>
                    <a href="#"><span>IG</span></a>
                    <a href="#"><span>TW</span></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Jam Operasional</h3>
                <p>Senin - Jumat: 10:00 - 22:00</p>
                <p>Sabtu - Minggu: 09:00 - 23:00</p>
                <p>Hari Libur: 09:00 - 23:00</p>
            </div>
            <div class="footer-column">
                <h3>Tautan Cepat</h3>
                <a href="#">Beranda</a>
                <a href="#">Menu</a>
                <a href="#">Promo</a>
                <a href="#">Lokasi</a>
                <a href="#">Kontak</a>
            </div>
            <div class="footer-column">
                <h3>Hubungi Kami</h3>
                <p>Jl. Ayam Goreng No. 123</p>
                <p>Kota Lezat, 12345</p>
                <p>info@ayamgorenglezat.com</p>
                <p>+62 8123 4567 890</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Ayam Goreng Lezat. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        // Functions to increase and decrease quantity
        function increaseQuantity(itemId) {
            const form = document.getElementById('updateForm' + itemId);
            const input = form.querySelector('.quantity-input');
            const btnPlus = form.querySelector('.increase-btn');
            const btnMinus = form.querySelector('.decrease-btn');

            // Disable buttons to prevent multiple clicks
            btnPlus.disabled = true;
            btnMinus.disabled = true;

            // Add visual feedback
            btnPlus.classList.add('btn-active');

            // Update value and submit with animation
            input.value = parseInt(input.value) + 1;

            // Show loading animation on the button
            btnPlus.innerHTML = '<span class="loading-spinner"></span>';

            setTimeout(() => {
                form.submit();
            }, 300);
        }

        function decreaseQuantity(itemId) {
            const form = document.getElementById('updateForm' + itemId);
            const input = form.querySelector('.quantity-input');
            const btnPlus = form.querySelector('.increase-btn');
            const btnMinus = form.querySelector('.decrease-btn');

            if (parseInt(input.value) > 1) {
                // Disable buttons to prevent multiple clicks
                btnPlus.disabled = true;
                btnMinus.disabled = true;

                // Add visual feedback
                btnMinus.classList.add('btn-active');

                // Update value and submit with animation
                input.value = parseInt(input.value) - 1;

                // Show loading animation on the button
                btnMinus.innerHTML = '<span class="loading-spinner"></span>';

                setTimeout(() => {
                    form.submit();
                }, 300);
            }
        }

        // Toggle Menu for Mobile
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }

        // Address form toggle
        const useSavedAddressRadio = document.getElementById('use-saved-address');
        const useNewAddressRadio = document.getElementById('use-new-address');
        const savedAddressesSection = document.getElementById('saved-addresses-section');
        const newAddressForm = document.getElementById('new-address-form');
        const selectedAddressIdInput = document.getElementById('selected-address-id');

        // Set default address ID if available
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan elemen ada sebelum mengakses propertinya
            if (selectedAddressIdInput) {
                const defaultAddressCard = document.querySelector('.address-card.selected');
                if (defaultAddressCard) {
                    selectedAddressIdInput.value = defaultAddressCard.dataset.addressId;
                }

                // Tambahkan fade out otomatis untuk pesan alert
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 500);
                    });
                }, 5000);
            }
        });

        // Toggle between saved and new address
        if (useSavedAddressRadio && useNewAddressRadio && savedAddressesSection && newAddressForm) {
            useSavedAddressRadio.addEventListener('change', function() {
                if (this.checked) {
                    savedAddressesSection.style.display = 'block';
                    newAddressForm.style.display = 'none';

                    // Reset selected address ID to default if available
                    const defaultAddressCard = document.querySelector('.address-card.selected');
                    if (defaultAddressCard && selectedAddressIdInput) {
                        selectedAddressIdInput.value = defaultAddressCard.dataset.addressId;
                    }
                }
            });

            useNewAddressRadio.addEventListener('change', function() {
                if (this.checked) {
                    savedAddressesSection.style.display = 'none';
                    newAddressForm.style.display = 'block';
                    if (selectedAddressIdInput) {
                        selectedAddressIdInput.value = 'new';
                    }
                }
            });
        }

        // Make address cards selectable
        const addressCards = document.querySelectorAll('.address-card');
        addressCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                addressCards.forEach(c => c.classList.remove('selected'));

                // Add selected class to clicked card
                this.classList.add('selected');

                // Update hidden input with selected address ID
                selectedAddressIdInput.value = this.dataset.addressId;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submissions with loading state
            const cartForms = document.querySelectorAll('form');

            cartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');

                    if (submitBtn && !submitBtn.classList.contains('quantity-btn')) {
                        // Create and show the loading spinner
                        const originalText = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<span class="loading-spinner-large"></span> ' + originalText;
                        submitBtn.classList.add('btn-loading');
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection

