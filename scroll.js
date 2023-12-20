
  // Seleciona todos os links que possuem a classe "scroll"
  const scrollLinks = document.querySelectorAll('.scroll');
  
  // Itera sobre cada link
  scrollLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault(); // Previne o comportamento padrão do link
      const href = link.getAttribute('href'); // Obtém o valor do atributo "href" do link
      const offsetTop = document.querySelector(href).offsetTop; // Obtém o deslocamento vertical da seção
      window.scrollTo({
        top: offsetTop, // Define a posição vertical para a qual a página deve rolar
        behavior: 'smooth' // Define a animação de rolagem suave
      });
    });
  });

