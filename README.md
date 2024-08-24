# ponderada_web_aws


## Visão Geral

Este projeto PHP cria e gerencia uma página web que permite o cadastro de clientes em um banco de dados. A página foi desenvolvida para fornecer uma interface simples para adicionar informações de clientes, visualizar dados existentes e gerenciar o banco de dados subjacente.

### Funcionalidades Principais

1. **Cadastro de Clientes**: A página permite o registro de novos clientes, coletando informações como nome, sobrenome, email e data de nascimento.
2. **Exibição de Dados**: Todos os clientes cadastrados são exibidos em uma tabela dinâmica na página.
3. **Conexão com Banco de Dados**: O código PHP se conecta a um banco de dados MariaDB para armazenar e recuperar os dados dos clientes.

### Estrutura da Tabela `CUSTOMERS`

A tabela `CUSTOMERS` é criada automaticamente caso ainda não exista, com os seguintes campos:

- **ID**: Identificador único para cada cliente (Tipo `INT` com `AUTO_INCREMENT`).
- **FIRST_NAME**: Nome do cliente (Tipo `VARCHAR(50)`).
- **LAST_NAME**: Sobrenome do cliente (Tipo `VARCHAR(50)`).
- **EMAIL**: Email do cliente (Tipo `VARCHAR(100)`).
- **DATE_OF_BIRTH**: Data de nascimento do cliente (Tipo `DATE`).
- **JOIN_DATE**: Data e hora em que o cliente foi adicionado (Tipo `TIMESTAMP` com valor padrão como a data e hora atuais).

A tabela possui pelo menos três tipos de dados diferentes (`INT`, `VARCHAR`, e `DATE`), garantindo diversidade e flexibilidade no armazenamento de informações.

## Hospedagem na AWS

Este projeto está hospedado na AWS, utilizando os serviços EC2 e RDS com MariaDB.

### Amazon EC2 (Elastic Compute Cloud)

O Amazon EC2 fornece capacidade de computação escalável na nuvem da AWS. Ele permite criar e configurar instâncias de servidores virtuais de acordo com as necessidades do projeto. Neste projeto, o EC2 é utilizado para hospedar o servidor web que executa o código PHP. O servidor EC2 oferece alta disponibilidade e fácil escalabilidade, garantindo que a aplicação possa lidar com diferentes volumes de tráfego e cargas de trabalho.

### Amazon RDS (Relational Database Service) com MariaDB

O Amazon RDS é um serviço gerenciado de banco de dados relacional que facilita a configuração, operação e escalabilidade de um banco de dados na nuvem. Para este projeto, o RDS é configurado com o MariaDB, uma das opções de banco de dados suportadas. O MariaDB oferece uma alternativa robusta e confiável ao MySQL, garantindo desempenho e segurança para os dados dos clientes. O uso do RDS elimina a necessidade de gerenciar o banco de dados manualmente, pois a AWS cuida de backups, atualizações e escalabilidade automática.

## Como Funciona

1. **Acesso à Página**: Os usuários acessam a página PHP hospedada no EC2 através de um navegador.
2. **Inserção de Dados**: Os usuários preenchem o formulário com as informações do cliente e enviam os dados.
3. **Armazenamento**: O código PHP se conecta ao RDS, onde o banco de dados MariaDB está hospedado, e armazena as informações do cliente na tabela `CUSTOMERS`.
4. **Exibição de Dados**: Os dados existentes são recuperados do banco de dados e exibidos na página em formato de tabela.

## Conclusão

Este projeto demonstra a integração de tecnologias PHP com serviços da AWS, como EC2 e RDS, para criar uma aplicação web dinâmica e escalável. A combinação de um servidor de aplicação robusto com um banco de dados gerenciado proporciona uma solução eficiente para o gerenciamento de dados de clientes.

## Link do vídeo 
Google drive: https://drive.google.com/file/d/1gMGEDpv2DmUC1dIFSR0wD2qCqVd6lYOy/view?usp=sharing
