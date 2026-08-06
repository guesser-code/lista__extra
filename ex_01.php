<!-- Exercício 16 – Analisador de Senhas
Uma empresa de segurança digital deseja validar automaticamente as senhas criadas
pelos colaboradores.
Crie uma função chamada analisarSenha() que receba uma senha e retorne um
array contendo:
● Quantidade de letras maiúsculas;
● Quantidade de letras minúsculas;
● Quantidade de números;
● Quantidade de caracteres especiais;
● Tamanho da senha;
● Nível de segurança:
○ Fraca
○ Média
○ Forte
○ Muito Forte
A classificação deve considerar:
● mínimo de 8 caracteres;
● presença de letras maiúsculas;
● letras minúsculas;
● números;
● caracteres especiais.
Requisitos
● Criar pelo menos 5 funções.
● Não repetir código.
● Cada função deve possuir apenas uma responsabilidade.
Dica de execução
1. Crie uma função para contar letras maiúsculas.
2. Outra para contar números.
3. Outra para contar caracteres especiais.
4. Crie uma função responsável apenas por classificar a senha.
5. A função principal apenas organiza o relatório. -->


<?php

function contarMaiusculas($senha) {
    return preg_match_all("/[A-Z]/", $senha);
}

function contarMinusculas($senha) {
    return preg_match_all("/[a-z]/", $senha);
}

function contarNumeros($senha) {
    return preg_match_all("/[0-9]/", $senha);
}

function contarEspeciais($senha) {
    return preg_match_all('/[^\p{L}\p{N}\s]/u', $senha);
}

function contarTamanho($senha) {
    return strlen($senha);
}

function classificarSenha($senha) {

    $tamanho = contarTamanho($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);

    if ($tamanho < 8) {
        return "Fraca";
    }

    $condicoes = 0;

    if ($maiusculas > 0) $condicoes++;
    if ($minusculas > 0) $condicoes++;
    if ($numeros > 0) $condicoes++;
    if ($especiais > 0) $condicoes++;

    if ($condicoes == 4) {
        return "Muito Forte";
    } elseif ($condicoes == 3) {
        return "Forte";
    } elseif ($condicoes == 2) {
        return "Média";
    } else {
        return "Fraca";
    }
}

function analisarSenha($senha) {

    return [
        "maiusculas" => contarMaiusculas($senha),
        "minusculas" => contarMinusculas($senha),
        "numeros" => contarNumeros($senha),
        "especiais" => contarEspeciais($senha),
        "tamanho" => contarTamanho($senha),
        "nivel" => classificarSenha($senha)
    ];
}


$senha = "VaiCorinthians@777";

$resultado = analisarSenha($senha);

echo "Senha: $senha <br><br>";

echo "Maiúsculas: " . $resultado["maiusculas"] . "<br>";
echo "Minúsculas: " . $resultado["minusculas"] . "<br>";
echo "Números: " . $resultado["numeros"] . "<br>";
echo "Especiais: " . $resultado["especiais"] . "<br>";
echo "Tamanho: " . $resultado["tamanho"] . "<br>";
echo "Nível: " . $resultado["nivel"] . "<br>";

?>