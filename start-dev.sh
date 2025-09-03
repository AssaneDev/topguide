#!/bin/bash

echo "🚀 Démarrage de l'environnement de développement TopGuide"

# Mettre en mode développement si on veut utiliser Vite dev
if [ "$1" = "dev" ]; then
    echo "📝 Passage en mode développement..."
    sed -i 's/APP_ENV=production/APP_ENV=local/' .env
    sed -i 's/APP_DEBUG=false/APP_DEBUG=true/' .env
    php artisan config:clear
    
    echo "🔧 Démarrage de Vite dev server..."
    npm run dev &
    
    echo "🌐 Démarrage de Laravel serve..."
    php artisan serve &
    
    echo "✅ Serveurs démarrés:"
    echo "- Laravel: http://localhost:8000"
    echo "- Vite: http://localhost:5173"
    
else
    # Mode production
    echo "🏭 Configuration en mode production..."
    sed -i 's/APP_ENV=local/APP_ENV=production/' .env
    sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
    
    echo "🔨 Compilation des assets..."
    npm run build
    
    echo "🗄️ Mise en cache Laravel..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    echo "✅ Application prête pour la production!"
fi