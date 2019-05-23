<div class="container">
    <form action="?controller=FornecedoresController&<?php echo isset($fornecedor->id) ? "method=atualizar&id={$fornecedor->id}" : "method=salvar"; ?>" method="post" >
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Fornecedores</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome do fornecedor:</label>
                <input type="text" readonly class="form-control col-sm-8" name="NOME_FORNECEDOR" id="NOME_FORNECEDOR" value="<?php
                echo isset($fornecedor->NOME_FORNECEDOR) ? $fornecedor->NOME_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CNPJ:</label>
                <input type="text" readonly class="cnpj form-control col-sm-8" name="CNPJ_FORNECEDOR" id="CNPJ_FORNECEDOR" value="<?php
                echo isset($fornecedor->CNPJ_FORNECEDOR) ? $fornecedor->CNPJ_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CPF:</label>
                <input type="text" readonly class="cpf form-control col-sm-8" name="CPF_FORNECEDOR" id="CPF_FORNECEDOR" value="<?php
                echo isset($fornecedor->CPF_FORNECEDOR) ? $fornecedor->CPF_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Inscrição estadual:</label>
                <input type="text" readonly class="InscricaoEstadual form-control col-sm-8" name="INSCRICAOESTADUAL_FORNECEDOR" id="INSCRICAOESTADUAL_FORNECEDOR" value="<?php
                echo isset($fornecedor->INSCRICAOESTADUAL_FORNECEDOR) ? $fornecedor->INSCRICAOESTADUAL_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Tipo:</label>
                <input type="text" readonly class="form-control col-sm-8" name="TIPO_FORNECEDOR" id="TIPO_FORNECEDOR" value="<?php
                echo isset($fornecedor->TIPO_FORNECEDOR) ? $fornecedor->TIPO_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Endereço:</label>
                <input type="text" readonly class="form-control col-sm-8" name="NDERECO_FORNECEDOR_7" id="NDERECO_FORNECEDOR_7" value="<?php
                echo isset($fornecedor->NDERECO_FORNECEDOR_7) ? $fornecedor->NDERECO_FORNECEDOR_7 : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Bairro:</label>
                <input type="text" readonly class="form-control col-sm-8" name="BAIRRO_FORNECEDOR" id="BAIRRO_FORNECEDOR" value="<?php
                echo isset($fornecedor->BAIRRO_FORNECEDOR) ? $fornecedor->BAIRRO_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Cidade:</label>
                <input type="text" readonly class="form-control col-sm-8" name="CIDADE_FORNECEDOR" id="CIDADE_FORNECEDOR" value="<?php
                echo isset($fornecedor->CIDADE_FORNECEDOR) ? $fornecedor->CIDADE_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">UF:</label>
                <input type="text" readonly class="estado form-control col-sm-8" name="UF_FORNECEDOR" id="UF_FORNECEDOR" value="<?php
                echo isset($fornecedor->UF_FORNECEDOR) ? $fornecedor->UF_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CEP:</label>
                <input type="text" readonly class="cep form-control col-sm-8" name="CEP_FORNECEDOR" id="CEP_FORNECEDOR" value="<?php
                echo isset($fornecedor->CEP_FORNECEDOR) ? $fornecedor->CEP_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Email:</label>
                <input type="text" readonly class="form-control col-sm-8" name="EMAIL_FORNECEDOR" id="EMAIL_FORNECEDOR" value="<?php
                echo isset($fornecedor->EMAIL_FORNECEDOR) ? $fornecedor->EMAIL_FORNECEDOR : null;
                ?>" />
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($fornecedor->id) ? $fornecedor->id : null; ?>" />
                <a class="btn btn-danger" href="?controller=FornecedoresController&method=relatorio">Voltar</a>
            </div>
        </div>
    </form>
</div>
