#!/bin/sh
set -e

# Garante que o autoload do Composer exista mesmo com volume montado
if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Gerando autoload do Composer..."
    composer dump-autoload --optimize --no-interaction
fi

# Assegura permissões adequadas no diretório de uploads
mkdir -p /var/www/html/uploads/resumes
chmod -R 777 /var/www/html/uploads/resumes 2>/dev/null || true

# Executa o comando passado para o container
exec "$@"
