<div class="container">
  <div class="section">
    <h4>Procurar Fornecedor</h4>
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
                <th>Fornecedor</th>
                <th>CNPJ</th>
                <th>CPF</th>
                <th>Inscrição estadual</th>
                <th>Tipo</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>CEP</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Celular</th>

            </tr>
        </thead>
        <h4>Fornecedores</h4>
        <tbody>
            <?php
            if ($fornecedores) {
                foreach ($fornecedores as $fornecedor) {
                    ?>
                    <tr>
                        <td><?php echo $fornecedor->NOME_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->CNPJ_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->CPF_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->INSCRICAOESTADUAL_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->TIPO_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->NDERECO_FORNECEDOR_7; ?></td>
                        <td><?php echo $fornecedor->BAIRRO_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->CIDADE_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->UF_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->CEP_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->EMAIL_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->TELEFONE_FORNECEDOR; ?></td>
                        <td><?php echo $fornecedor->CELULAR_FORNECEDOR; ?></td>
                        <td>
                          <a href="?controller=FornecedoresController&method=relatorio&id=<?php echo $fornecedor->id; ?>" class="btn btn-primary btn-sm">Visualizar</a>
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
