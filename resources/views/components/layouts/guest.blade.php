<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }} - SIJAMAT-PRO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        :root {
            --stage-surface: #f2f6ff;
            --stage-accent: #dbe6ff;
            --stage-soft: #f8fbff;
        }

        body {
            background:
                radial-gradient(circle at 15% 10%, rgba(84, 123, 243, 0.2), transparent 32%),
                radial-gradient(circle at 90% 88%, rgba(58, 102, 231, 0.18), transparent 28%),
                linear-gradient(145deg, var(--stage-surface) 0%, var(--stage-accent) 45%, var(--stage-soft) 100%);
        }
    </style>
</head>
<body class="min-h-screen font-sans text-slate-800 antialiased">
    {{ $slot }}
</body>
</html>