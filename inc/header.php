<?php 
$project_root = '/sistempakar_adopsihewan'; 

$filename = basename($_SERVER['PHP_SELF']);

if ($filename == 'index.php') {
    $current_page = 'home';
} elseif ($filename == 'gallery.php' || $filename == 'detail.php') {
    $current_page = 'gallery';
} elseif ($filename == 'konsultasi.php' || $filename == 'pertanyaan.php' || $filename == 'hasil.php' || $filename == 'pertanyaan_diagnosa.php' || $filename == 'hasil_diagnosa.php') {
    $current_page = 'konsultasi';
} else {
    $current_page = '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Gallery Pet System' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        .nav-link {
            padding-bottom: 6px; 
            transition: border-bottom 0.2s;
        }
        .nav-link.active {
            font-weight: 700;
            color: #3b82f6; /* blue-500 */
            border-bottom: 2px solid #3b82f6;
        }
        .wix-cta-button {
        position: relative;
        display: inline-block;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: #ffffffff; 
        background-color: transparent; 
        border: 2px solid #f7f7f7ff; 
        border-radius: 4px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .wix-cta-button:hover {
        color: white; 
        background-color: #2563eb; 
        border-color: #2563eb; 
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
    }
    
    .wix-cta-button:hover .fas {
        transform: translateX(5px);
    }

    .wix2-cta-button {
        position: relative;
        display: inline-block;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: #2563eb; 
        background-color: transparent; 
        border: 2px solid #2563eb;
        border-radius: 4px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    

    .wix2-cta-button:hover {
        color: white; 
        background-color: #2563eb; 
        border-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
    }
    
    .wix2-cta-button:hover .fas {
        transform: translateX(5px);
    }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-sans">

<header class="bg-white shadow-lg fixed w-full z-30 header-sticky   ">
    <div class="w-full mx-auto px-4 md:px-6 py-4 flex flex-wrap justify-between items-center">
        <div class="flex items-center space-x-3 flex-shrink-0">
            <a href="<?= $project_root ?>/index.php" class="flex items-center space-x-3">
                <img src="<?= $project_root ?>/assets/logo/logo.png" alt="Logo" class="w-10 h-10 rounded-full object-cover shadow-md">
                <h1 class="text-xl md:text-2xl font-extrabold text-gray-800">Pets<span class="text-blue-500">Wiki</span></h1>
            </a>
        </div>

        <button id="menu-toggle" class="md:hidden p-2 flex-shrink-0 text-blue-500 hover:text-blue-700 transition duration-150">
            <svg id="icon-menu-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            <svg id="icon-menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <nav id="menu-links" class="hidden md:flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 mt-4 md:mt-0 w-full md:w-auto items-center">
            
            <a href="<?= $project_root ?>/index.php" class="nav-link inline-block p-2 text-gray-600 hover:text-blue-500 transition duration-150 <?= ($current_page == 'home') ? 'active' : '' ?>">Home</a>
            <a href="<?= $project_root ?>/gallery.php" class="nav-link inline-block p-2 text-gray-600 hover:text-blue-500 transition duration-150 <?= ($current_page == 'gallery') ? 'active' : '' ?>">Gallery</a>
            <a href="<?= $project_root ?>/konsultasi.php" class="nav-link inline-block p-2 text-gray-600 hover:text-blue-500 transition duration-150 <?= ($current_page == 'konsultasi') ? 'active' : '' ?>">Konsultasi</a>
            <a href="#" class="nav-link inline-block p-2 text-gray-600 hover:text-blue-500 transition duration-150 <?= ($current_page == 'about') ? 'active' : '' ?>">About</a>
            
        </nav>
    </div>
</header>
<main class="flex-grow">