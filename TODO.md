# CSS
* OK - fazer o orientadores no menu ter hover também
* OK - remover selecao pink
* h2 das listas de post (ex noticias nao tem margin-bottom), os de subtitulo tipo Ingresso/introducao tem (30px)
* tamanho do "Download video: WebM format | MP4 format" tem que ser igual ao do "ler todas as noticias"
* colocar a setinha no submenu (exemplo: depois de orientadores e alunos)

# custom post types

* OK - Disciplina
* OK - Orientador
* Aluno
* Post de Professor
* para customizar a listagem de posts customizados http://yoast.com/custom-post-type-snippets/


# Documentos

* Uma página cheia de attachments

# Ingresso

* sub-sessoes colapsaveis
* mestrado e doutorado como sub-paginas
* menu funcionando com sub-páginas

## Mestrado

## Doutorado


# Orientadores

* Botão de imprimir

## Credenciados

* Adicionar Professor
* Lista colapsável

### Professor

* Sidebar esquerda (RSS)
  * Links relacionados
* Botão imprimir
* Endereço profissional e biografia retiradas do Lattes

## Ex-Orientadores


# Resultado de buscas de notícias

* TBD

# Resultado de buscas de disciplinas

* TBD

# Pagina de Impressão

* Mudar a fonte para a mesma da página
* Caixa alta nos títulos
* sumir com o "No Comments"
* sumir com o horario apos a @
* tentar localizar os textos \"posted by\", \"article printed from\", \"url to article\", \"urls in this post\"
* ver como imprimir apenas um pedaço em páginas que tem expand/colapse (ex professores)
* tentar pular a pagina de print
* usar o papel timbrado?


# Geral

* favicon, ipod icon, etc
* startup images? https://gist.github.com/472519
* home screen icon para iDevices

#CSS geral

* - tirar seleção rosa
* OK - links undeline no hover (para padronizar com os de baixo)

# Bugs

* Search results está vindo com a caixa de entidades relacionadas
* Editor visual do wordpress arranca paragrafos
* URLs das imagens quebram quando online (www) e nas paginas de impressao
* quando muda para ingles ou espanhol, o separador | está aparecendo
* ver como tirar atributo title dos itens do menu
* entidades relacionadas está hardcoded no template, isto é feio/errado
* footer.php está com endereços e telefones hardcoded, isto é feio/errado

# Página de notícia individual

* TBD

# Template functions

* OK - create and pre-fill default pages with the content of pages\_content folder, update if pages_content is newer
* rewrite function boilerplate\_posted\_on

# Dev server (pgsm.nulo.com.br)

* OK - script to update code
* script to sync database
* run this scripts automatically via cron or URL ping

# Template localization

* translate to english and spanish all __() and _e() strings of pgsm-boilerplate-child
* translate "Mais Notícias" button

# Disciplinas

* OK - Post type disciplina
* OK - pagina disciplinas lista todos os posts de tipo disciplina
* Botao Mais Disciplinas carregar ajax
* Pagina de disciplina individual deve ter o menuitem "disciplinas" como o selecionado
* Expand / Colapse animado
* trocar de volta o limite de numero de disciplinas por pagina para o default escolhido

# Página de "todas as notícias"

* OK - incluir "publicado por PGSM"
* OK - Expand / Colapse das noticias individuais
* OK - Css da dobra/resquicio de divisor depois do titulo da noticia
* OK - Botao mais noticias no mesmo estilo css do "abrir no google mapas"
* Botao Mais Noticias carregar ajax
* Pagina de noticia individual deve ter o menuitem "noticias" como o selecionado
* Expand / Colapse animado
* trocar de volta o limite de numero de noticias por pagina para o default escolhido


# Home

* Colocar placeholder de foto estatica
* Testar video fallback para flash em browsers sem html5 video
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


# Sites de interesse

* OK - gerar todos os pngs dos logos
* OK - decidir se eles vao como gallery ou parte do template

# Localização

* OK - Botão de imprimir
* OK - Google maps embed
* OK - Botão \"Abrir no Google Mapas\"


# Lembretes

* Quando instalar ativar os plugins 
* Quando instalar selecionar a opção de usar home e posts page estaticas







# FUTURE

* trocar URL dos videos para uma versão no archive.org ou no servidor da USP (p/ sair da conta do GStorage do fabricio)

http://commondatastorage.googleapis.com/pgsm/pgsm1080.mp4
http://commondatastorage.googleapis.com/pgsm/pgsm360.mp4
http://commondatastorage.googleapis.com/pgsm/pgsm360.webm
http://commondatastorage.googleapis.com/pgsm/pgsm480.flv
http://commondatastorage.googleapis.com/pgsm/pgsm480.webm
http://commondatastorage.googleapis.com/pgsm/pgsm720.mp4
http://commondatastorage.googleapis.com/pgsm/pgsm720.webm

## Blog de professores (MULTISITE)?

* reinstalar wordpress com multisite abilitado
* testar para ver se/quais plugins quebram
* decidir se quer subdominio ou subdiretorio