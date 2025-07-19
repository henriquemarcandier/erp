<footer class="bg-light text-center text-muted py-3 mt-5">
  <div class="container">
    <small>
      &copy - <?=date('Y')?> - Desenvolvido por 
      <a href="#" data-bs-toggle="modal" data-bs-target="#modalHenrique">Henrique Marcandier</a>
    </small>
  </div>
</footer>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalHenrique" tabindex="-1" aria-labelledby="modalHenriqueLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHenriqueLabel">Quem sou eu – Henrique Marcandier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="row align-items-start">
          <div class="col-md-4 text-center">
            <img src="images/henrique.png" class="img-fluid rounded" alt="Henrique Marcandier">
          </div>
          <div class="col-md-8">
            <p>Sou Henrique Marcandier, estudante de Análise e Desenvolvimento de Sistemas, apaixonado por criar soluções práticas e funcionais que realmente resolvam problemas do mundo real. Comecei no desenvolvimento com foco em PHP puro, e desde então venho expandindo meu conhecimento com boas práticas, MVC e integrações úteis como ViaCEP e webhooks.</p>
            <p>Este projeto de mini ERP foi desenvolvido com o objetivo de controlar pedidos, cupons, produtos e estoque de forma objetiva e organizada, usando PHP, MySQL e Bootstrap. Busco sempre alinhar simplicidade com eficiência.</p>
            <p>Tenho interesse em evoluir como desenvolvedor fullstack, trabalhando com APIs, frameworks modernos, e arquitetura limpa. Adoro desafios que envolvam lógica, refatoração e usabilidade.</p>
            <p>Se quiser me conhecer melhor, acompanhar meu progresso ou colaborar, sinta-se à vontade para entrar em contato. Estou aberto a novas oportunidades e projetos!</p>
            <p>Email: <a href="mailto:henrique.marcandier@gmail.com">henrique.marcandier@gmail.com</a></p>
            <p>Telefone: <a href="tel:+5531998466628">(31) 99846-6628</a></p>
            <p>WhatsApp: <a href="https://api.whatsapp.com/send?l=pt&phone=5531998466628" target="_blank">Clique aqui</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
