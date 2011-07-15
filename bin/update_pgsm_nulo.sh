cd /home/nulo/www
cp -f pgsm.nulo.com.br/www/wp-config.php .
cp -f pgsm.nulo.com.br/www/.htaccess .htaccess-wp
rm -rf pgsm.nulo.com.br
git clone git://github.com/fczuardi/pgsm.git pgsm.nulo.com.br
cd pgsm.nulo.com.br/www/wp-content/themes/
git clone git://github.com/fczuardi/pgsm-boilerplate-child.git
cd /home/nulo/www
cp -f wp-config.php pgsm.nulo.com.br/www/.
cp -f .htaccess-wp pgsm.nulo.com.br/www/.htaccess
chmod -R 755 pgsm.nulo.com.br