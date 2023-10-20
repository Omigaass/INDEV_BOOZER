// Elementos da paginação
    const prevPageBtn = document.querySelector(".prev_page");
    const currentPageLabel = document.querySelector(".current_page");
    const nextPageBtn = document.querySelector(".next_page");

    // Configurações iniciais
    let currentPage = 1;
    const itemsPerPage = 5;

    // Função para atualizar a exibição com base na página atual
    function updatePage() {
        // Lógica para mostrar/ocultar objetos com base na página atual
        const products = document.querySelectorAll('.p_start');
        const productsLine = document.querySelectorAll('.p_line');

        for (let i = 0; i < products.length; i++) {
            if (i >= (currentPage - 1) * itemsPerPage && i < currentPage * itemsPerPage) {
                products[i].style.display = 'flex';
                if (products[i].classList.contains("list_view")) {
                    if (productsLine[i]) {
                        productsLine[i].style.display = 'flex';
                    }
                }
            } else {
                products[i].style.display = 'none';
                if (productsLine[i]) {
                    productsLine[i].style.display = 'none';
                }
            }
        }
        

        currentPageLabel.textContent = currentPage;
    }

    // Event listeners para os botões de paginação
    prevPageBtn.addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            updatePage();
        }
    });

    nextPageBtn.addEventListener("click", function () {
        const products = document.querySelectorAll('.p_start');
        if (currentPage * itemsPerPage < products.length) {
            currentPage++;
            updatePage();
        }
    });

    // Inicializa a exibição
    updatePage();