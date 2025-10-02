/* =============================================================
   SISTEMA DE NAVEGAÇÃO AJAX - CARREGAMENTO DE TELAS
   ============================================================= */

 $(document).ready(function () {
  // Aplicar tema imediatamente no carregamento
  applyInitialTheme();
  
  // Cache para páginas carregadas
  const pageCache = {};
  let isLoading = false;

  // Criar overlay de loading
  const loadingOverlay = createLoadingOverlay();

 // Interceptar cliques em links do menu
 $(document).on('click', 'a[href$=".php"]:not([target="_blank"])', function (e) {
  e.preventDefault();

  const url = $(this).attr('href');
  const linkText = $(this).text().trim();

  // Verificar se é link interno
  if (url && !url.startsWith('http') && !url.startsWith('mailto:')) {
   loadPageAjax(url, linkText);
  }
 });

 // Função para criar overlay de loading
 function createLoadingOverlay() {
  const overlay = $(`
            <div id="ajax-loading-overlay" style="
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.9);
                z-index: 99999;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            ">
                <div class="loading-spinner" style="
                    width: 60px;
                    height: 60px;
                    border: 4px solid #f3f3f3;
                    border-top: 4px solid #0d4f3c;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                "></div>
                <p style="
                    margin-top: 20px;
                    color: #0d4f3c;
                    font-weight: bold;
                    font-size: 18px;
                ">Carregando...</p>
            </div>
        `);

  // Adicionar CSS para animação
  if (!$('#ajax-spinner-css').length) {
   $('head').append(`
                <style id="ajax-spinner-css">
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    #ajax-loading-overlay {
                        backdrop-filter: blur(3px);
                        -webkit-backdrop-filter: blur(3px);
                    }
                    [data-theme="dark"] #ajax-loading-overlay {
                        background: rgba(45, 45, 45, 0.9) !important;
                    }
                    [data-theme="dark"] #ajax-loading-overlay p {
                        color: #4ade80 !important;
                    }
                    [data-theme="dark"] #ajax-loading-overlay .loading-spinner {
                        border-top-color: #4ade80 !important;
                    }
                </style>
            `);
  }

  $('body').append(overlay);
  return overlay;
 }

 // Função para mostrar loading
 function showLoading() {
  if (!isLoading) {
   isLoading = true;
   loadingOverlay.fadeIn(300);
  }
 }

 // Função para esconder loading
 function hideLoading() {
  if (isLoading) {
   isLoading = false;
   loadingOverlay.fadeOut(300);
  }
 }

 // Função principal para carregar página via AJAX
 function loadPageAjax(url, pageTitle) {
  if (isLoading) return; // Evitar múltiplas requisições

  // Verificar se página está em cache
  if (pageCache[url]) {
   showCachedPage(url, pageTitle);
   return;
  }

  showLoading();

  // Fazer requisição AJAX com timeout
  $.ajax({
   url: url,
   type: 'GET',
   dataType: 'html',
   timeout: 15000, // 15 segundos timeout
   cache: false,
   success: function (data) {
    try {
     // Extrair conteúdo da página
     const $response = $(data);
     let pageContent = '';

     // Tentar extrair o conteúdo principal
     const $pageWrapper = $response.find('#page-wrapper');
     if ($pageWrapper.length > 0) {
      pageContent = $pageWrapper.html();
     } else {
      // Fallback: extrair body
      const $body = $response.find('body');
      if ($body.length > 0) {
       pageContent = $body.html();
      } else {
       pageContent = data;
      }
     }

     // Validar se o conteúdo foi extraído corretamente
     if (!pageContent || pageContent.trim().length < 100) {
      throw new Error('Conteúdo inválido recebido');
     }

     // Cachear a página
     pageCache[url] = {
      content: pageContent,
      timestamp: Date.now(),
      title: pageTitle
     };

     // Aguardar 1 segundo antes de mostrar (conforme solicitado)
     setTimeout(function () {
      updatePageContent(pageContent, pageTitle);
      updatePageScripts($response);
      updateActiveMenu(url);
      updateBrowserHistory(url, pageTitle);
      hideLoading();
     }, 1000);

    } catch (error) {
     console.error('Erro ao processar resposta:', error);
     hideLoading();
     // Fallback para navegação normal
     window.location.href = url;
    }
   },
   error: function (xhr, status, error) {
    console.error('Erro AJAX:', status, error);
    hideLoading();

    // Mostrar erro amigável
    if (xhr.status === 404) {
     alert('Página não encontrada: ' + url);
    } else if (xhr.status === 500) {
     alert('Erro interno do servidor. Tentando recarregar...');
     window.location.href = url;
    } else {
     // Fallback para navegação normal
     window.location.href = url;
    }
   }
  });
 }

 // Função para mostrar página do cache
 function showCachedPage(url, pageTitle) {
  const cached = pageCache[url];
  if (cached) {
   // Verificar se cache não está muito antigo (5 minutos)
   const now = Date.now();
   if (now - cached.timestamp < 300000) {
    setTimeout(function () {
     updatePageContent(cached.content, pageTitle);
     updateActiveMenu(url);
     updateBrowserHistory(url, pageTitle);
    }, 500); // Cache é mais rápido
    return;
   }
  }

  // Cache expirado ou não existe, recarregar
  loadPageAjax(url, pageTitle);
 }

  // Função para atualizar conteúdo da página
  function updatePageContent(content, title) {
   const $mainContainer = $('#page-wrapper');
   
   // Preservar tema atual ANTES de qualquer mudança
   const currentTheme = document.body.getAttribute('data-theme');
   const bodyClasses = document.body.className;
   
   // Aplicar tema imediatamente para evitar flash
   applyThemeInstantly(currentTheme);

   if ($mainContainer.length > 0) {
    // Fade out atual
    $mainContainer.fadeOut(200, function () {
     // Atualizar conteúdo
     $mainContainer.html(content);

     // Restaurar tema e classes IMEDIATAMENTE
     restoreThemeAndClasses(currentTheme, bodyClasses);
     
     // Forçar aplicação do tema
     forceThemeApplication(currentTheme);

     // Fade in novo conteúdo
     $mainContainer.fadeIn(200);
    });
   } else {
    // Fallback: atualizar body inteiro
    $('body').html(content);
    
    // Restaurar tema e classes IMEDIATAMENTE
    restoreThemeAndClasses(currentTheme, bodyClasses);
    
    // Forçar aplicação do tema
    forceThemeApplication(currentTheme);
   }

   // Atualizar título
   if (title) {
    document.title = title + ' - EasyBank';
   }
  }
  
  // Função para aplicar tema instantaneamente
  function applyThemeInstantly(theme) {
   if (theme === 'dark') {
    // Forçar cores escuras imediatamente
    document.body.style.backgroundColor = '#292929';
    document.documentElement.style.backgroundColor = '#292929';
    
    // Aplicar cores aos elementos principais
    const $navbar = $('.navbar-cls-top');
    const $sidebar = $('.navbar-side');
    const $footer = $('.footer');
    const $pageWrapper = $('#page-wrapper');
    
    if ($navbar.length) $navbar.css('background-color', '#2d2d2d');
    if ($sidebar.length) $sidebar.css('background-color', '#2d2d2d');
    if ($footer.length) $footer.css('background-color', '#2d2d2d');
    if ($pageWrapper.length) $pageWrapper.css('background-color', '#2d2d2d');
   } else {
    // Forçar cores claras imediatamente
    document.body.style.backgroundColor = '#f8f9fa';
    document.documentElement.style.backgroundColor = '#f8f9fa';
    
    // Aplicar cores aos elementos principais
    const $navbar = $('.navbar-cls-top');
    const $sidebar = $('.navbar-side');
    const $footer = $('.footer');
    const $pageWrapper = $('#page-wrapper');
    
    if ($navbar.length) $navbar.css('background-color', '#ffffff');
    if ($sidebar.length) $sidebar.css('background-color', '#ffffff');
    if ($footer.length) $footer.css('background-color', '#ffffff');
    if ($pageWrapper.length) $pageWrapper.css('background-color', '#ffffff');
   }
  }
  
  // Função para restaurar tema e classes
  function restoreThemeAndClasses(theme, classes) {
   // Restaurar tema
   if (theme) {
    document.body.setAttribute('data-theme', theme);
   } else {
    document.body.removeAttribute('data-theme');
   }
   
   // Restaurar classes
   document.body.className = classes;
  }
  
  // Função para forçar aplicação do tema
  function forceThemeApplication(theme) {
   if (theme === 'dark') {
    // Forçar CSS do tema escuro
    $('head').append(`
     <style id="temp-dark-theme">
      body[data-theme="dark"] {
       background-color: #292929 !important;
      }
      body[data-theme="dark"] .navbar-cls-top {
       background-color: #2d2d2d !important;
      }
      body[data-theme="dark"] .navbar-side {
       background-color: #2d2d2d !important;
      }
      body[data-theme="dark"] .footer {
       background-color: #2d2d2d !important;
      }
      body[data-theme="dark"] #page-wrapper {
       background-color: #2d2d2d !important;
      }
      body[data-theme="dark"] .panel,
      body[data-theme="dark"] .card,
      body[data-theme="dark"] .form-card {
       background-color: #2d2d2d !important;
      }
     </style>
    `);
    
    // Remover CSS temporário após um tempo
    setTimeout(() => {
     $('#temp-dark-theme').remove();
     // Limpar estilos inline
     document.body.style.backgroundColor = '';
     document.documentElement.style.backgroundColor = '';
     $('.navbar-cls-top, .navbar-side, .footer, #page-wrapper').css('background-color', '');
    }, 1000);
   } else {
    // Forçar CSS do tema claro
    $('head').append(`
     <style id="temp-light-theme">
      body:not([data-theme]) {
       background-color: #f8f9fa !important;
      }
      body:not([data-theme]) .navbar-cls-top {
       background-color: #ffffff !important;
      }
      body:not([data-theme]) .navbar-side {
       background-color: #ffffff !important;
      }
      body:not([data-theme]) .footer {
       background-color: #ffffff !important;
      }
      body:not([data-theme]) #page-wrapper {
       background-color: #ffffff !important;
      }
      body:not([data-theme]) .panel,
      body:not([data-theme]) .card,
      body:not([data-theme]) .form-card {
       background-color: #ffffff !important;
      }
     </style>
    `);
    
    // Remover CSS temporário após um tempo
    setTimeout(() => {
     $('#temp-light-theme').remove();
     // Limpar estilos inline
     document.body.style.backgroundColor = '';
     document.documentElement.style.backgroundColor = '';
     $('.navbar-cls-top, .navbar-side, .footer, #page-wrapper').css('background-color', '');
    }, 1000);
   }
  }

 // Função para executar scripts da nova página
 function updatePageScripts($response) {
  // Executar scripts inline
  $response.find('script').each(function () {
   const scriptContent = $(this).html();
   if (scriptContent && scriptContent.trim()) {
    try {
     // Verificar se não é um script externo
     if (!$(this).attr('src')) {
      eval(scriptContent);
     }
    } catch (e) {
     console.warn('Erro ao executar script:', e);
    }
   }
  });

  // Re-inicializar componentes específicos
  reinitializeComponents();
 }

 // Função para re-inicializar componentes
 function reinitializeComponents() {
  // Re-inicializar máscaras
  if (typeof aplicarMascaraTelefone === 'function') {
   $('input[id="telefone"]').each(function () {
    if (this.value) {
     aplicarMascaraTelefone(this);
    }
   });
  }

  if (typeof aplicarMascaraMonetaria === 'function') {
   $('input[name="saldo"], input[name="valor"], input[id="saldo"], input[id="valor"]').each(function () {
    if (this.value) {
     aplicarMascaraMonetaria(this);
    }
   });
  }

  // Re-inicializar eventos de formulário
  $('form').off('submit.ajax').on('submit.ajax', function (e) {
   // Permitir envio normal de formulários
   // O AJAX só intercepta navegação, não formulários
  });

  // Re-inicializar tooltips se existirem
  if (typeof $('[data-toggle="tooltip"]').tooltip === 'function') {
   $('[data-toggle="tooltip"]').tooltip();
  }

  // Re-inicializar DataTables se existirem
  if (typeof $.fn.DataTable === 'function') {
   $('.dataTable').each(function () {
    if (!$.fn.DataTable.isDataTable(this)) {
     $(this).DataTable();
    }
   });
  }
 }

 // Função para atualizar menu ativo
 function updateActiveMenu(url) {
  // Remover classes ativas
  $('#main-menu a').removeClass('current-page active');

  // Extrair nome do arquivo
  const fileName = url.split('/').pop().split('.')[0];

  // Adicionar classe ativa
  $('#main-menu a[href*="' + fileName + '"]').addClass('current-page active');

  // Atualizar dropdowns
  updateActiveDropdowns(fileName);
 }

 // Função para atualizar dropdowns ativos
 function updateActiveDropdowns(fileName) {
  const pageDropdowns = {
   'nova_categoria': 'categorias',
   'consultar_categoria': 'categorias',
   'alterar_categoria': 'categorias',
   'nova_empresa': 'empresas',
   'consultar_empresa': 'empresas',
   'alterar_empresas': 'empresas',
   'nova_conta': 'contas',
   'consultar_conta': 'contas',
   'alterar_contas': 'contas',
   'realizar_movimento': 'movimentos',
   'consultar_movimento': 'movimentos'
  };

  const dropdownName = pageDropdowns[fileName];
  if (dropdownName) {
   // Abrir dropdown correspondente
   const $dropdownToggle = $('a[href="#' + dropdownName + '"]');
   if ($dropdownToggle.length > 0) {
    $dropdownToggle.parent().find('.nav-second-level').addClass('active');
    $dropdownToggle.find('.dropdown-arrow').addClass('rotated');
   }
  }
 }

 // Função para atualizar histórico do navegador
 function updateBrowserHistory(url, title) {
  if (history.pushState) {
   history.pushState({ url: url, title: title }, title, url);
  }
 }

 // Gerenciar botões voltar/avançar
 window.addEventListener('popstate', function (e) {
  if (e.state && e.state.url) {
   loadPageAjax(e.state.url, e.state.title);
  }
 });

 // Limpar cache periodicamente
 setInterval(function () {
  const now = Date.now();
  Object.keys(pageCache).forEach(function (url) {
   if (now - pageCache[url].timestamp > 300000) { // 5 minutos
    delete pageCache[url];
   }
  });
 }, 60000); // Verificar a cada minuto

 // Função para limpar cache manualmente
 window.clearPageCache = function () {
  pageCache = {};
  console.log('Cache de páginas limpo');
 };

 // Função para navegar programaticamente
 window.navigateToPage = function (url, title) {
  loadPageAjax(url, title || 'EasyBank');
 };

  // Função para aplicar tema inicial imediatamente
  function applyInitialTheme() {
   const savedTheme = localStorage.getItem('theme');
   const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
   
   let themeToApply = '';
   if (savedTheme) {
    themeToApply = savedTheme;
   } else if (prefersDark) {
    themeToApply = 'dark';
   } else {
    themeToApply = 'light';
   }
   
   // Aplicar tema imediatamente
   if (themeToApply === 'dark') {
    document.body.setAttribute('data-theme', 'dark');
    document.documentElement.style.backgroundColor = '#292929';
    document.body.style.backgroundColor = '#292929';
   } else {
    document.body.removeAttribute('data-theme');
    document.documentElement.style.backgroundColor = '#f8f9fa';
    document.body.style.backgroundColor = '#f8f9fa';
   }
   
   // Limpar estilos inline após um tempo
   setTimeout(() => {
    document.documentElement.style.backgroundColor = '';
    document.body.style.backgroundColor = '';
   }, 500);
  }

  console.log('Sistema de navegação AJAX inicializado');
 });
