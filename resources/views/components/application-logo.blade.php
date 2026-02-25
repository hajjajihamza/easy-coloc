<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" {{ $attributes }} role="img" aria-label="EasyColoc logo">
    <title>EasyColoc - Colocation simplifiée</title>
    <desc>Logo représentant une maison avec deux personnages et un cœur, symbolisant le partage et la vie en colocation</desc>

    <!-- Définitions pour réutilisation -->
    <defs>
        <!-- Gradient subtil pour la maison -->
        <linearGradient id="houseGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#60A5FA;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
        </linearGradient>

        <!-- Style commun pour les éléments -->
        <style>
            .stroke-base { stroke: #1E3A8A; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
            .fill-primary { fill: url(#houseGradient); }
            .fill-accent { fill: #8B5CF6; }
            .fill-warm { fill: #F59E0B; }
            .fill-heart { fill: #EF4444; }
            .text-base { font-family: 'Inter', system-ui, -apple-system, sans-serif; font-weight: 700; fill: #1F2937; }
        </style>
    </defs>

    <!-- Toit (simplifié et mieux proportionné) -->
    <polygon points="25,85 100,25 175,85" class="fill-primary stroke-base"/>

    <!-- Corps de la maison -->
    <rect x="45" y="85" width="110" height="75" rx="8" class="fill-primary stroke-base"/>

    <!-- Cheminée (discrète) -->
    <rect x="125" y="40" width="10" height="25" rx="2" fill="#94A3B8" stroke="#64748B" stroke-width="1"/>

    <!-- Fenêtres (design minimaliste) -->
    <g class="stroke-base" fill="#FFFFFF">
        <rect x="60" y="100" width="28" height="28" rx="4"/>
        <rect x="112" y="100" width="28" height="28" rx="4"/>
        <!-- Croisillons subtils -->
        <line x1="74" y1="100" x2="74" y2="128" stroke="#94A3B8" stroke-width="1"/>
        <line x1="60" y1="114" x2="88" y2="114" stroke="#94A3B8" stroke-width="1"/>
        <line x1="126" y1="100" x2="126" y2="128" stroke="#94A3B8" stroke-width="1"/>
        <line x1="112" y1="114" x2="140" y2="114" stroke="#94A3B8" stroke-width="1"/>
    </g>

    <!-- Porte avec poignée -->
    <rect x="85" y="125" width="30" height="35" rx="4" fill="#FFFFFF" class="stroke-base"/>
    <circle cx="107" cy="142" r="2.5" fill="#64748B"/>

    <!-- Personnages intégrés (dans les fenêtres = vie partagée) -->
    <g transform="translate(67, 107)">
        <circle cx="0" cy="0" r="5" class="fill-accent"/>
        <rect x="-4" y="5" width="8" height="10" rx="2" class="fill-accent"/>
    </g>
    <g transform="translate(126, 107)">
        <circle cx="0" cy="0" r="5" fill="#10B981"/>
        <rect x="-4" y="5" width="8" height="10" rx="2" fill="#10B981"/>
    </g>

    <!-- Cœur central (symbole de partage, bien formé) -->
    <path class="fill-heart" d="M100,68
    C100,65 102,63 105,63
    C108,63 110,65 110,68
    C110,72 105,78 100,82
    C95,78 90,72 90,68
    C90,65 92,63 95,63
    C98,63 100,65 100,68 Z"/>

    <!-- Subtile lueur autour du cœur -->
    <circle cx="100" cy="70" r="18" fill="none" stroke="#FCA5A5" stroke-width="1" opacity="0.4" stroke-dasharray="4 2"/>
</svg>

<a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">{{ config('app.name', 'EasyColoc') }}</span>
</a>
