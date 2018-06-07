sudo rm /var/www/crm && \
sudo ln -s /var/www/crm_current /var/www/crm && \
cd /var/www/crm && \
# sudo APP_ENV=$APP_ENV DATABASE_URL=$DATABASE_URL php bin/console doctrine:migrations:migrate --no-interaction && \
sudo APP_ENV=$APP_ENV DATABASE_URL=$DATABASE_URL && \
sudo chown -R www-data:www-data /var/www/crm_current && \
sudo chown -h www-data:www-data /var/www/crm && \
sudo service apache2 restart
