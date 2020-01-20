## Desafio Arquivei

Desenvolvido por Raabe Noa

## Docker

Os arquivos *Dockerfile* e vhost.conf se encontram na pasta ./docker na raiz do projeto.

#Chaves de acesso

Alterar no arquivo .env as variáveis de ambiente X_API_ID e X_API_KEY para os valores corretos das chaves de acesso.

## Organização do projeto

- Na rota index (/) estão listadas as opções disponíveis: 
    - /nfes: "Importar dados da API" conecta a aplicação com a api e armazena a resposta na base de dados.
    - /list: "Listar notas fiscal" redireciona para a view que contém a lista de registros da base de dados e busca por um registro específico.
