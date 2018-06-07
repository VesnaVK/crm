# Remove symlink
sudo rm -R /var/www/crm_old && \
sudo cp -R /var/www/crm_current /var/www/crm_old/ && \
sudo rm /var/www/crm && \
sudo rm -R /var/www/crm_current && \
# Create symlink to older version && \
sudo ln -s /var/www/crm_old /var/www/crm
