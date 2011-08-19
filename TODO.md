# Documentos

* (5/08 - 8/08) Uma página cheia de attachments

# Ingresso

* OK - menu funcionando com sub-páginas
* (8/08) sub-sessoes colapsaveis
* (8/08) mestrado e doutorado como sub-paginas

## Mestrado

* (8/08) pagina de mestrado

## Doutorado

* (8/08) pagina de doutorado

# Regulamento

* (9/08) até 2008
* (9/08) a partir de 2009

#Dissertações e Teses

* (10/08 - 15/08) TBD

# custom post types

* OK - Disciplina
* OK - Orientador
* OK - Post de Professor (nao é mais custom type)
* OK - para customizar a listagem de posts customizados http://yoast.com/custom-post-type-snippets/
* OK - Aluno

# Orientadores

* OK - Listagem por categoria credenciados
* OK - Listagem por categoria ex-orientadores
* OK - ordenar alfabeticamente por nome
* OK - custom fields add to meta box: ```http://codex.wordpress.org/Function_Reference/add_meta_box```
* OK - como colocar o titulo na frente do nome (Prof. Dr. e Prof. Dra. por exemplo)
* OK - categorias credenciados e exorientador nao deveriam aparecer na tela de post comum
  * OK - trocar por custom field
* OK - orientador tem que ter metadado com o username para listar os posts
* OK - lattes, twitter, wikipedia, lattes, etc: http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields ou http://thomasgriffinmedia.com/blog/2010/09/how-to-add-custom-user-contact-info-in-wordpress/
* OK - Template html e css para pagina de um orientador
* OK - Aside
  * OK - Profile picture
  * TBD - se for customizar o plugin user photo para atualizar programaticamente procure por nop codigo update_usermeta
  * OK - Últimos Posts
    * OK - Preencher link com RSS dos ultimos posts
    * OK - Link para ler todos os posts
    * OK - Pagina com todos os posts
  * OK - Links relacionados
* Prefill de conteudo na pagina de "adicionar novo orientador"
* (17/08) carregar mais(paginacao) com ajax
* (18/08) Pagina individual de orientador
* (19/08) mudar comportamento do Botão de imprimir
* (later) Endereço profissional e biografia retiradas do Lattes

# CSS
* OK - fazer o orientadores no menu ter hover também
* OK - remover selecao pink
* OK - h2 das listas de post (ex noticias nao tem margin-bottom), os de subtitulo tipo Ingresso/introducao tem (30px)
* OK - na home ultimas noticias e entidades relacionadas precisam ser do mesmo tamanho de video institucional e fotos
* OK - arrumar broken images da sidebar no nulo.com.br
* OK - tamanho do "Download video: WebM format | MP4 format" tem que ser igual ao do "ler todas as noticias"
* (16/08) colocar a setinha no submenu (exemplo: depois de orientadores e alunos)
* (16/08) colocar sombra no topo do submenu

# Geral

* (16/08) favicon, ipod icon, etc
* (16/08) startup images? https://gist.github.com/472519
* (16/08) home screen icon para iDevices

# Disciplinas

* OK - Post type disciplina
* OK - pagina disciplinas lista todos os posts de tipo disciplina
* (16/08) Botao Mais Disciplinas carregar ajax
* (16/08) Expand / Colapse animado
* (deploy-day) trocar de volta o limite de numero de disciplinas por pagina para o default escolhido

# Página de "todas as notícias"

* OK - incluir "publicado por PGSM"
* OK - Expand / Colapse das noticias individuais
* OK - Css da dobra/resquicio de divisor depois do titulo da noticia
* OK - Botao mais noticias no mesmo estilo css do "abrir no google mapas"
* (16/08) Botao Mais Noticias carregar ajax
* (16/08) Expand / Colapse animado
* (deploy-day) trocar de volta o limite de numero de noticias por pagina para o default escolhido

# Pagina de Impressão

* (17/08) Mudar a fonte para a mesma da página
* (17/08) Caixa alta nos títulos
* (17/08) sumir com o "No Comments"
* (17/08) sumir com o horario apos a @
* (17/08) tentar localizar os textos \"posted by\", \"article printed from\", \"url to article\", \"urls in this post\"
* (17/08) ver como imprimir apenas um pedaço em páginas que tem expand/colapse (ex professores)
* (17/08) tentar pular a pagina de print
* (17/08) usar o papel timbrado?

# Home

* (17/08) Colocar placeholder de foto estatica no vídeo
* (deploy-day) Testar video fallback para flash em browsers sem html5 video
* OK - Menu: hover com borda arredondada
* OK - Cabeçalho: título e descrição posicionados
* OK - Sidebar: mudar título para \"últimas notícias\"
* OK - Sidebar: Horario e título na posição / formato corretos, separadores entre as noticias
* OK - Sidebar: ícone RSS linkando p/ o feed
* OK - Header: seletor de línguas, funcionalidade
* OK - Header: seletor de línguas, posição / tamanho
* OK - Conteúdo: html da home, video embed
* OK - Conteúdo: html da home, grid de fotos
* OK - Conteúdo: css dos títulos Video institucional e fotos
* OK - Bug: remover bool(false) da nav bar
* OK - Sidebar: link \"ler todas as notícias\"
* OK - Sidebar: widget Entidades Relacionadas

# Histórico

* (18/08) TBD

# Resultado de buscas de disciplinas

* (18/08) TBD
* layout igual a lista de disciplinas
* layout da pagina de nothing found
  * Nenhuma disciplina encontrada é o título
  * campo para pequisar de novo
* titulo DISCIPLINAS QUE CONTÉM: <termo de busca>

# Resultado de buscas de notícias

* (18/08) TBD
* termo de busca highlited?


# Página de notícia individual

* (18/08) TBD

# Página de disciplina individual

* (18/08) TBD

# Página de orientador individual

* (18/08) TBD

# Página de aluno individual?

* (18/08) TBD?

# Bugs

* listagem de noticias tem que ser collapsible
* titulos dos posts vem com (Português) quando outra lingua está selecionada
* imagens das entidades relacionadas somem quando muda de lingua
* clicar em qqer regiao de um orientador aberto da colapse no post
* busca da tela de nothing found nao pode buscar em tudo se veio da pagina de disciplinas, orientadores, etc
* (10/08) IE6/7 support ou redirect p/ instalacao do chrome frame ou update
* (18/08) Search results está vindo com a caixa de entidades relacionadas
* (16/08) quando muda para ingles ou espanhol, o separador | está aparecendo
* (16/08) ver como tirar atributo title dos itens do menu
* (18/08) Pagina de disciplina individual deve ter o menuitem "disciplinas" como o selecionado
* (18/08) Pagina de noticia individual deve ter o menuitem "noticias" como o selecionado
* (deploy-day) URLs das imagens quebram quando online (www) e nas paginas de impressao
* (later) entidades relacionadas está hardcoded no template, isto é feio/errado
* (later) footer.php está com endereços e telefones hardcoded, isto é feio/errado
* (never) Editor visual do wordpress arranca paragrafos


#CSS geral

* OK - tirar seleção rosa
* OK - links undeline no hover (para padronizar com os de baixo)

## Credenciados

* OK - Adicionar Professor
* OK - Lista colapsável

# Sites de interesse

* OK - gerar todos os pngs dos logos
* OK - decidir se eles vao como gallery ou parte do template

# Localização

* OK - Botão de imprimir
* OK - Google maps embed
* OK - Botão \"Abrir no Google Mapas\"


# Lembretes

* (deploy-day) Quando instalar ativar os plugins 
* (deploy-day) Quando instalar selecionar a opção de usar home e posts page estaticas







# Documentacoes

## Simples
* Como adicionar um professor?
  * adicionar wordpress user com role de Author.
  * criar nova pagina de Orientador credenciado
* Como adicionar um ex-Orientador?
* Como adicionar uma notícia?
* Como adicionar um post na pagina de um professor?
* Como adicionar uma disciplina?
* Como mudar as fotos da galeria da home page?
* Como cadastrar novos alunos?
* Como traduzir uma página.
* Como um professor pode mudar sua foto, links e website.

## Perigosas
* Atualizar o wordpress.
* Instalar ou atualizar plugin de wordpress.
* Mudar rodapé, localização ou sites de interesse.















# FUTURE

* (future) trocar URL dos videos para uma versão no archive.org ou no servidor da USP (p/ sair da conta do GStorage do fabricio)

## Template functions

* OK - create and pre-fill default pages with the content of pages\_content folder, update if pages_content is newer
* (future) rewrite function boilerplate\_posted\_on


## Template localization

* (future) translate to english and spanish all __() and _e() strings of pgsm-boilerplate-child
* (future) translate "Mais Notícias" button

## Dev server (pgsm.nulo.com.br)

* OK - script to update code
* (never) script to sync database
* (never) run this scripts automatically via cron or URL ping


## Blog de professores (MULTISITE)?

* reinstalar wordpress com multisite abilitado
* testar para ver se/quais plugins quebram
* decidir se quer subdominio ou subdiretorio