/* =============================================================
   MENU TOGGLE OTIMIZADO - VERSÃO LIMPA E FUNCIONAL
   ============================================================= */

(function() {
    'use strict';
    
    // Configurações
    const CONFIG = {
        STORAGE_KEY: 'menuState',
        DEFAULT_STATE: 'expanded',
        ANIMATION_DURATION: 300
    };
    
    // Elementos DOM
    let elements = {};
    
    // Estado do menu
    let currentState = CONFIG.DEFAULT_STATE;
    
    /**
     * Inicializa os elementos DOM
     */
    function initElements() {
        elements = {
            toggle: document.getElementById('menu-toggle-checkbox'),
            sidebar: document.querySelector('.navbar-side'),
            pageWrapper: document.getElementById('page-wrapper'),
            footer: document.querySelector('.footer')
        };
        
        
        return elements.sidebar && elements.pageWrapper;
    }
    
    /**
     * Aplica o estado do menu
     */
    function applyState(state, isUserInteraction = false) {
        if (!elements.sidebar || !elements.pageWrapper) return;
        
        // Limpar classes
        const classes = ['collapsed', 'expanded'];
        elements.sidebar.classList.remove(...classes);
        elements.pageWrapper.classList.remove(...classes);
        if (elements.footer) elements.footer.classList.remove(...classes);
        
        // Aplicar novo estado
        elements.sidebar.classList.add(state);
        elements.pageWrapper.classList.add(state);
        if (elements.footer) elements.footer.classList.add(state);
        if (elements.toggle) elements.toggle.checked = (state === 'expanded');
        
        // Aplicar rotação apenas se for interação do usuário
        const menuBtn = document.querySelector('.menu-toggle-btn');
        if (menuBtn) {
            if (isUserInteraction) {
                menuBtn.classList.add('clicked');
            } else {
                // Remover classe 'clicked' quando não é interação do usuário
                menuBtn.classList.remove('clicked');
            }
        }
        
        currentState = state;
        localStorage.setItem(CONFIG.STORAGE_KEY, state);
    }
    
    /**
     * Alterna o estado do menu
     */
    function toggleMenu() {
        const newState = currentState === 'expanded' ? 'collapsed' : 'expanded';
        applyState(newState);
    }
    
    /**
     * Inicializa o menu toggle
     */
    function initMenuToggle() {
        if (!initElements()) return;
        
        // Carregar estado salvo (sem rotação automática)
        const savedState = localStorage.getItem(CONFIG.STORAGE_KEY) || CONFIG.DEFAULT_STATE;
        applyState(savedState, false); // false = não é interação do usuário
        
        // Event listener para o checkbox
        if (elements.toggle) {
            elements.toggle.addEventListener('change', function() {
                const newState = this.checked ? 'expanded' : 'collapsed';
                applyState(newState, true); // true = é interação do usuário
            });
        }
        
        // Event listener para redimensionamento
        window.addEventListener('resize', function() {
            applyState(currentState, false); // false = não é interação do usuário
        });
    }
    
    // Inicializar quando DOM estiver pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMenuToggle);
    } else {
        initMenuToggle();
    }
    
})();
