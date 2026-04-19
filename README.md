# HypeWaveMart – WordPress Theme

Tema de WordPress feito sob medida para uma loja de **produtos virais** e **dropshipping** focada no mercado dos EUA.  
Baseado no layout moderno escuro “HypeWaveMart”, com integração para WooCommerce, seções de trending products, flash sale, top sellers e reviews.

> Este tema nasceu a partir de um template antigo estático (`index.html` / uStora/uCommerce) e foi totalmente refeito para WordPress + WooCommerce.

---

## ⚙️ Requisitos

- **WordPress** 6.0+
- **PHP** 8.0+
- **WooCommerce** (opcional, mas recomendado)
- Servidor comum de hospedagem (Apache/Nginx) ou Localhost (XAMPP, LocalWP etc.)

---

## 📁 Estrutura do Tema

```text
hypewavemart/
├── style.css                 # Cabeçalho do tema (obrigatório para WP)
├── functions.php             # Configurações gerais, scripts, WooCommerce
├── header.php                # Cabeçalho do site (logo, menu, busca, topo)
├── footer.php                # Rodapé (colunas, social, métodos de pagamento)
├── index.php                 # Fallback padrão (blog / listagem)
├── front-page.php            # Home especial HypeWaveMart
├── page.php                  # Páginas estáticas (Sobre, Contato etc.)
├── single.php                # Post individual do blog
├── archive.php               # Arquivos de blog, categorias, tags etc.
├── 404.php                   # Página de erro 404
├── assets/
│   ├── css/
│   │   ├── main.css          # Estilo principal (layout escuro, hero, grid)
│   │   └── woocommerce.css   # Ajustes de estilo para WooCommerce
│   └── js/
│       └── main.js           # Menu mobile, newsletter fake, AJAX add-to-cart
└── woocommerce/
    └── content-product.php   # Card de produto customizado (grid da loja)
```

---

## 🚀 Instalação

### 1. Baixar o tema

Você tem duas opções:

**Opção A – Download ZIP**

1. Clique no botão verde **Code** aqui no GitHub.
2. Clique em **Download ZIP**.
3. Extraia o arquivo `.zip` no seu computador.
4. Renomeie a pasta para `hypewavemart` (sem “-main” ou similar).

**Opção B – Clonar (para quem usa git)**

```bash
git clone https://github.com/SEU-USUARIO/hypewavemart-theme.git
mv hypewavemart-theme hypewavemart
```

---

### 2. Colocar o tema no WordPress

1. Entre na pasta da sua instalação WordPress.
2. Abra `wp-content/themes/`.
3. Copie a pasta **hypewavemart** para dentro de `themes/`, ficando assim:

```text
wp-content/
  themes/
    hypewavemart/
      style.css
      functions.php
      ...
```

4. No painel Admin do WordPress, vá em **Aparência → Temas**.
5. Ative o tema **HypeWaveMart**.

---

### 3. Instalar WooCommerce (recomendado)

1. No painel WordPress, vá em **Plugins → Adicionar novo**.
2. Procure por **WooCommerce**.
3. Instale e ative.
4. Siga o assistente inicial (moeda, país, métodos de pagamento etc.).

O tema automaticamente:
- Dá suporte a WooCommerce.
- Ajusta o layout da loja para o estilo HypeWaveMart.
- Mostra cards de produto customizados com:
  - Badges: “Viral”, “Hot”, “New”
  - Desconto em %
  - Barra de “sold” (vendidos)

---

## 🏠 Configurar a Home (HypeWaveMart)

O arquivo `front-page.php` controla a homepage.

1. Crie uma página em **Páginas → Adicionar nova**, chame de “Home”.
2. Vá em **Configurações → Leitura**:
   - Em “Sua página inicial exibe”, escolha **Uma página estática**.
   - Página inicial: selecione **Home**.
3. A home vai automaticamente usar `front-page.php`, com:
   - Hero (Tomorrow’s Viral Products, Today.)
   - Faixa de confiança (Free shipping, 30-day returns etc.).
   - Grid de categorias (ícones 📱🏡💄…)
   - Seção **Trending Now** (produtos ordenados por meta `_hwm_sold_count`)
   - **Flash Sale** (produtos em promoção)
   - **Top Sellers** (produtos com mais vendas de WooCommerce)
   - Reviews fake (texto estático, você pode trocar depois)
   - Newsletter

> Para ativar as seções com produtos reais, é preciso ter produtos cadastrados no WooCommerce.

---

## 🛒 Como os produtos aparecem

### 1. Trending Now

No `front-page.php`, a seção “Trending Now” faz um `WP_Query`:

- Busca produtos (`post_type = product`)
- Ordena pelo meta `_hwm_sold_count`
- Mostra 8 itens

Esse meta `_hwm_sold_count` é atualizado automaticamente cada vez que um pedido passa para status **Concluído**, via hook no `functions.php`.

### 2. Flash Sale

- Busca produtos que estejam com `sale_price` diferente de vazio.
- Mostra 4 produtos em promoção.

### 3. Top Sellers

- Ordena por meta `total_sales` (meta padrão do WooCommerce).
- Mostra 4 produtos mais vendidos.

---

## 🎨 Layout & Estilo

O visual é todo controlado por:

- `assets/css/main.css` – layout principal:
  - Tema escuro
  - Header fixo
  - Announcement bar
  - Hero com gradiente e cards laterais
  - Grid de categorias
  - Product cards
  - Banner strip
  - Reviews, newsletter, footer

- `assets/css/woocommerce.css` – ajuste do WooCommerce:
  - Grid da loja com 4 colunas
  - Single product (imagem + resumo lado a lado)
  - Estilo de carrinho e checkout
  - Botões padrão WooCommerce com o estilo HypeWaveMart

Se quiser mudar as cores principais, altere no início de `main.css`:

```css
:root {
  --brand:      #ff3c5f;
  --brand-dark: #c8002f;
  --accent:     #ff8c00;
  --dark:       #0f0f14;
  ...
}
```

---

## 🧩 JS (interações)

O arquivo `assets/js/main.js` cuida de:

- Menu mobile (`toggleMobileNav`, `closeMobileNav`)
- Newsletter fake (só exibe alert, depois você pode integrar Mailchimp/Klaviyo)
- “Wishlist” visual (toggle de classe, sem backend ainda)
- Add to Cart via AJAX (usando hooks do WooCommerce)
- Timer de **Flash Sale** (countdown de 6h a partir do carregamento)

> Para o add-to-cart AJAX funcionar, WooCommerce precisa estar ativo (usa `wc_add_to_cart_params`).

---

## 🔧 Customização recomendada

- Trocar textos fixos (inglês → português ou vice-versa) em:
  - `front-page.php`
  - `footer.php`
  - `header.php`
- Criar páginas:
  - About, How it Works, FAQ, Shipping Info, Returns, Contact
- Criar categorias de produto:
  - `tiktok-viral`, `top-sellers`, `mystery-box`, etc.
- Instalar plugin de reviews (Ex: Judge.me, Loox, CusRev) se quiser reviews reais no lugar dos fakes.

---

## 📌 Notas

- Tema pensado para **loja de dropshipping / produtos virais** (TikTok, Amazon finds etc.).
- O template HTML original (uStora/uCommerce, arquivo `index.html`) foi usado apenas como referência e não é mais necessário para o funcionamento em WordPress.
- Sinta-se livre para forkar, customizar e adaptar para sua própria marca.

---

## 🧑‍💻 Autor

Criado para HypeWaveMart por **Jasson**, com auxílio da IA (Inner AI Fusion).  
Focado em alta conversão, visual moderno e estrutura simples de manter.
