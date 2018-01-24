# Gerador de Token do Instagram e Classe para utilização

Este script gera o token do Instagram para utilização da API e mostrar fotos no seu site e/ou sistema em PHP.

### Pré requisitos

Entre no site da [API](https://www.instagram.com/developer/) do Instagram e crie um novo cliente definindo a URI como **http://localhost/insta**
Utilize este sistema com o endereço **http://localhost/insta**

### Gerar o Token

Com o Client ID e o Client Secret em mãos, insira os dados no formulário, cuidado para não copiar espaço junto.
O mesmo irá gerar o Token necessário para utilizar na Classe.

### Utilizando a Classe

Importe o arquivo com a Classe Instagram em seu código, para utilizar, basta seguir conforme abaixo:
```
	$Insta = new Instagram;
	$Insta::setToken(Token); // Token gerado
	$Insta::setUsername(usuario); //Usuário do Instagram
	$Insta::setNumerPhotos(3); //Definir quantas imagens será buscada

	$insta_result = $Insta::getPhotos();
```

## License

Projeto desenvolvido por Gerson Arbigaus.
