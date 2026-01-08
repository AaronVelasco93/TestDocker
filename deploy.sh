#!/usr/bin/env bash
set -euo pipefail

# === CONFIG ===
REPO_URL="${1:-}"
APP_DIR="${2:-/opt/php-mysql-test}"

if [[ -z "${REPO_URL}" ]]; then
  echo "Uso: ./deploy.sh <REPO_URL> [APP_DIR]"
  echo "Ejemplo: ./deploy.sh https://github.com/tuusuario/php-mysql-docker-test.git /opt/php-mysql-test"
  exit 1
fi

echo "==> Deploy en: ${APP_DIR}"
sudo mkdir -p "${APP_DIR}"
sudo chown -R "$USER:$USER" "${APP_DIR}"

if [[ ! -d "${APP_DIR}/.git" ]]; then
  echo "==> Clonando repo..."
  git clone "${REPO_URL}" "${APP_DIR}"
else
  echo "==> Actualizando repo..."
  cd "${APP_DIR}"
  git pull
fi

cd "${APP_DIR}"

# Crear .env si no existe
if [[ ! -f ".env" ]]; then
  echo "==> No existe .env, creando desde .env.example"
  cp .env.example .env
  echo "   EDITA .env con tus contraseñas (recomendado)."
fi

echo "==> Construyendo y levantando contenedores..."
docker compose up -d --build

echo "==> Estado:"
docker compose ps

echo "==> Listo. Abre: http://3.133.58.227"
