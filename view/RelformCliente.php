<script  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
  });>

</script>
<div class="container">
    <form action="?controller=ClientesController&<?php echo isset($cliente->id) ? "method=atualizar&id={$cliente->id}" : "method=salvar"; ?>" method="post" >
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Cliente</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome do cliente:</label>
                <input type="text" readonly class="form-control col-sm-8" name="NOME_CLIENTE" id="NOME_CLIENTE" value="<?php
                echo isset($cliente->NOME_CLIENTE) ? $cliente->NOME_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CPF do cliente:</label>
                <input type="text" readonly class="cpf form-control col-sm-8" name="CPF_CLIENTE" id="CPF_CLIENTE" value="<?php
                echo isset($cliente->CPF_CLIENTE) ? $cliente->CPF_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">RG do cliente:</label>
                <input type="text" readonly class="rg form-control col-sm-8" name="RG_CLIENTE" id="RG_CLIENTE" value="<?php
                echo isset($cliente->RG_CLIENTE) ? $cliente->RG_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Data de nascimento:</label>
                <input type="date" readonly class="date form-control col-sm-8" name="DT_NASCIMENTO" id="DT_NASCIMENTO" value="<?php
                echo isset($cliente->DT_NASCIMENTO) ? $cliente->DT_NASCIMENTO : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Data de cadastro:</label>
                <input type="date" readonly class="date form-control col-sm-8" name="DT_CADASTRO" id="DT_CADASTRO" value="<?php
                echo isset($cliente->DT_CADASTRO) ? $cliente->DT_CADASTRO : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Telefone do cliente:</label>
                <input type="text" readonly class="telefone form-control col-sm-8" name="TELEFONE" id="TELEFONE" value="<?php
                echo isset($cliente->TELEFONE) ? $cliente->TELEFONE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">EMAIL do cliente:</label>
                <input type="text" readonly class="form-control col-sm-8" name="EMAIL" id="EMAIL" value="<?php
                echo isset($cliente->EMAIL) ? $cliente->EMAIL : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CNPJ do cliente:</label>
                <input type="text" readonly class="cnpj form-control col-sm-8" name="CNPJ_CLIENTE" id="CNPJ_CLIENTE" value="<?php
                echo isset($cliente->CNPJ_CLIENTE) ? $cliente->CNPJ_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Tipo do cliente:</label>
                <input type="text" readonly class="form-control col-sm-8" name="TIPO_CLIENTE" id="TIPO_CLIENTE" value="<?php
                echo isset($cliente->TIPO_CLIENTE) ? $cliente->TIPO_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Referencia do cliente:</label>
                <input type="text" readonly class="form-control col-sm-8" name="REFERENCIA_CLIENTE" id="REFERENCIA_CLIENTE" value="<?php
                echo isset($cliente->REFERENCIA_CLIENTE) ? $cliente->REFERENCIA_CLIENTE : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Celular do cliente:</label>
                <input type="text" readonly class="celular form-control col-sm-8" name="CELULAR" id="CELULAR" value="<?php
                echo isset($cliente->CELULAR) ? $cliente->CELULAR : null;
                ?>" />
            </div>
            <div>
              <table class="highlight" style="top:40px;" id="myTable">
                    <thead>
                        <tr>
                            <th>Código da Venda</th>
                            <th>Data da Venda</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <h4>Compras do Cliente</h4>
                      <tbody>
                          <?php
                          if ($vendas) {
                              foreach ($vendas as $venda) {
                                  ?>
                                  <tr>
                                      <td><?php echo $venda->ID; ?></td>
                                      <td><?php echo $venda->DATA_VENDA_CAB; ?></td>
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
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($cliente->id) ? $cliente->id : null; ?>" />
                <a class="btn btn-danger" href="?controller=ClientesController&method=RelCliente">Voltar</a>
            </div>
        </div>

    </form>
</div>
