# Web Site PGSM - FMRP, USP

Novo website da Pós Graduação de Saúde Mental da Faculdade de Medicina de Ribeirão Preto.

***EM CONSTRUÇÃO***

# Instalação

TBD (documentação em construção no [wiki do projeto](https://github.com/fczuardi/pgsm/wiki/_pages)).

# Sobre o sistema

O site é baseado na plataforma Wordpress, para instalação é necessário uma máquina com Apache, MySQL e PHP.

# Repositórios relacionados

Este projeto possui três repositórios relacionados:

* [pgsm-boilerplate-child](https://github.com/fczuardi/pgsm-boilerplate-child)
* [pgsm-wiki](https://github.com/fczuardi/pgsm/wiki/_access)
* [pgsm-projeto](https://github.com/fczuardi/pgsm-projeto)

## pgsm-boilerplate-child

Tema contendo todas as customizações do site, é onde se concentra a maior parte do código produzido. É instanciado como um submódulo git no diretório ````www/wp-content/themes/pgsm-boilerplate-child````.

## pgsm-wiki

Documentação do sistema, páginas de ajuda e referência sobre como instalar o site, como usar o site, como contribuir com o código e coisas do tipo. É o wiki que pode ser acessado online em https://github.com/fczuardi/pgsm/wiki

É instanciado como um submódulo git no diretório ````wiki````.

## pgsm-projeto

Contém os documentos produzidos durante a etapa de levantamento de requisitos e durante a etapa de design. Wireframes, documentos providenciados pela faculdade, mockups e layouts produzidos pelo Designer contratado(Mauricio Zuardi da [mnmo](http://mnmo.com.br)).

Por se tratar de um download grande é mantido separado e não faz partes dos submódulos do repositório principal.

# Plugins (and plugin customizations)

Lista parcial dos plugins de Wordpress usados neste site:

* [iframe](http://wordpress.org/extend/plugins/iframe/) versão 1.4.0.
  * [site do autor](http://web-profile.com.ua/wordpress/plugins/iframe/)
* [qTranslate](http://wordpress.org/extend/plugins/qtranslate/) versão 2.5.24
  * [site do autor](http://www.qianqin.de/qtranslate/)
  * [customização 1](https://github.com/fczuardi/pgsm/commit/2111ad0d057a3dd5d2248f037efefffda2190508) - Remove o ítem com a língua ativa do html ao invés de só mudar a classe.
* [unattach](http://wordpress.org/extend/plugins/unattach/) versão 1.0.1
  * [site do autor](http://outlandishideas.co.uk/blog/2011/03/unattach/)
* [ps-disable-auto-formatting](http://wordpress.org/extend/plugins/ps-disable-auto-formatting/) versão 1.0.6
  * http://www.web-strategy.jp/wp_plugin/ps_disable_auto_formatting/
  
# Fallback font (Francophil Sans)

* http://www.dafont.com/font.php?file=francophil_sans by Manfred Klein
  * License: http://manfred-klein.ina-mar.com/ 
  
    ````Manfred’s fonts are free for private and charity use. They are even free for commercial use – but if there’s any profit, pls make a donation to organizations like Doctors Without Borders.````
    ````These fonts can NOT be included in any compilation CDs, disks or products, either commercial or shareware unless prior permission granted.````

## Copyright / Licença

TBD (ainda não foi definida, provavelmente será AGPL + CC-by para as imagens do tema, mas não temos o sinal verde da faculdade para isso ainda). Por enquanto, todos os direitos reservados.
