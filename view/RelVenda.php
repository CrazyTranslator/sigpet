<div class="container">
  <div class="section">
  <h4>Procurar Venda</h4>
  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
              } else {
                  tr[i].style.display = "none";
                }
              }
            }
          }
        </script>
  <table class="highlight" style="top:40px;" id="myTable">
        <thead>
            <tr>
                <th>Código da Venda</th>
                <th>Data da Venda</th>
                <th>CLiente</th>
                <th>Valor Total</th>


            </tr>
        </thead>
        <h4>Vendas</h4>
        <tbody>
            <?php
            if ($vendas) {
                foreach ($vendas as $venda) {
                    ?>
                    <tr>
                        <td><?php echo $venda->ID; ?></td>
                        <td><?php echo $venda->DATA_VENDA_CAB; ?></td>
                        <td><?php echo $venda->NOME_CLIENTE; ?></td>
                        <td><?php echo $venda->VALOR_VENDA_CAB; ?></td>
                        <td>
                            <a href="?controller=VendasController&method=relatorio&id=<?php echo $venda->ID; ?>" class="btn btn-primary btn-sm">Visualizar</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">Nenhum registro encontrado</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
  </div>
</div>
