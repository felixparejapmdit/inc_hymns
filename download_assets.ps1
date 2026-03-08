# Localize Assets Script for INC Hymns
# Run this script to download all external dependencies to the local public folder

# Create directories
$baseDir = Get-Location
$cssDir = Join-Path $baseDir "public/css/vendor"
$jsDir = Join-Path $baseDir "public/js/vendor"
$fontsDir = Join-Path $baseDir "public/fonts"

New-Item -ItemType Directory -Force -Path $cssDir, $jsDir, $fontsDir

# URLs to download
$files = @{
    "https://cdn.plyr.io/3.6.8/plyr.css" = Join-Path $cssDir "plyr.css"
    "https://cdn.plyr.io/3.6.8/plyr.polyfilled.js" = Join-Path $jsDir "plyr.js"
    "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" = Join-Path $jsDir "jquery.min.js"
    "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js" = Join-Path $jsDir "pdf.min.js"
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" = Join-Path $cssDir "all.min.css"
    
    # Fonts
    "https://fonts.gstatic.com/s/inter/v20/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuLyfMZg.ttf" = Join-Path $fontsDir "inter-400.ttf"
    "https://fonts.gstatic.com/s/inter/v20/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuGKYMZg.ttf" = Join-Path $fontsDir "inter-600.ttf"
    "https://fonts.gstatic.com/s/inter/v20/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuFuYMZg.ttf" = Join-Path $fontsDir "inter-700.ttf"
    "https://fonts.bunny.net/figtree/files/figtree-latin-400-normal.woff2" = Join-Path $fontsDir "figtree-400.woff2"
    "https://fonts.bunny.net/figtree/files/figtree-latin-500-normal.woff2" = Join-Path $fontsDir "figtree-500.woff2"
    "https://fonts.bunny.net/figtree/files/figtree-latin-600-normal.woff2" = Join-Path $fontsDir "figtree-600.woff2"
}

Write-Host "Downloading external assets (JS, CSS, Fonts)..."
foreach ($url in $files.Keys) {
    $outFile = $files[$url]
    Write-Host "Fetching $url -> $outFile"
    try {
        Invoke-WebRequest -Uri $url -OutFile $outFile -TimeoutSec 30
    } catch {
        Write-Warning "Failed to download $url : $_"
    }
}

Write-Host "`nAssets downloaded successfully to public/ folder."
Write-Host "Note: You can now update your CSS to use @font-face with the local files in public/fonts/"
