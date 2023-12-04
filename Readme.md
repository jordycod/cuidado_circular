# Cuidado Circular - V0.1

Plataforma para auxiliar na Psicoterapia de crianças através de atividades lúdicas e da automação e análise de prontuários. 

## Informações adicionais:
Este projeto foi criado como atividade da cadeira de Projeto Integrado II em 2023.2, no curso de Sistemas e Mídias Digitais na UFC e tem como intuito auxiliar na construção 
de um dos produtos e serviços oferidos pela equipe do [Cuidado Circular](https://www.instagram.com/cuidado.circular/). 

Alunos da equipe:
* JORDY MUNIZ ARAUJO - 500872
* LARISSA ARAUJO AGUIAR - 496384
* LETÍCIA DE LIMA TORRES - 496492
* VANESKA KAREN DE SOUSA SILVA - 476389 
* VINICIUS DOS SANTOS BATISTA - 504247

## Como baixar o projeto e rodar? 

O projeto está em Wordpress de forma local, sendo assim, siga o seguinte passo-a-passo:

1. Baixe os Arquivos do Projeto WordPress: Clone o repositório do projeto WordPress local já existente ou baixe os arquivos do projeto de outra fonte confiável.
2. Configure o Ambiente Local: Certifique-se de ter um ambiente local configurado com um servidor web (por exemplo, Apache, Nginx) e PHP. Você pode usar ferramentas como XAMPP, MAMP ou instalar individualmente.
3. Crie um Banco de Dados Local: Utilize o painel de controle do seu ambiente local para criar um banco de dados MySQL. Anote as credenciais do banco de dados (nome do banco, usuário e senha).
4. Importe os Dados do Banco de Dados:
5. Importe os dados do banco de dados do projeto WordPress para o banco de dados local. Você pode usar ferramentas como phpMyAdmin ou a linha de comando do MySQL para realizar a importação.
6. Configure o Arquivo wp-config.php:
  * Vá até o diretório raiz do seu projeto WordPress e copie o arquivo wp-config-sample.php para wp-config.php.
  * Abra o arquivo wp-config.php em um editor de texto e insira as informações do banco de dados locais (nome do banco, usuário e senha).
7. Desative a Criptografia da Senha MD5:
8. Adicione o seguinte trecho de código no arquivo wp-config.php para desativar a criptografia MD5 e permitir senhas não criptografadas:
<PRE> Copy code
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);
define('PASSWORDHASH', 'plain'); 
</PRE>
9. Acesse o WordPress no Navegador: Abra seu navegador e acesse http://localhost/nomedoseusite (substitua nomedoseusite pelo caminho real do seu site no ambiente local).
10. Faça Login com a Senha MD5:
11. Faça login no painel de administração do WordPress usando o nome de usuário e a senha existentes no projeto, considerando que a senha está criptografada em MD5.

## RoadMap

| Funcionalidade                                                        | Impacto  x Esforço | Prioridade (1 a 3) |
|------------------------------------------------------------------------|-------------------|--------------------|
| Implementar um fluxo de terapia mais suave e fidedigno com os feedbacks coletados | Alto x Médio | 1                  |
| Criar anotações na sessão de Jogos para que a psicóloga não precise mudar de tela para preencher a evolução | Médio x Médio | 2                  |
| Visualização de dados em formato de dashboard                         | Alto x Alto | 1                  |
| Atualizar perguntas da Anamnese e da evolução conforme documentos repassados | Alto x Baixo | 1                  |
| Atualizar informações de cadastro de psicólogo e de pacientes conforme documentos repassados | Médio x Baixo | 2                  |
| Implementar IA para trabalhar com testes psicológicos                  | Médio x Alto | 3                  |
| Validar a automação dos testes psicológicos                            | Alto x Médio | 2                  |
| Implementar os “highlights” do cliente                                | Médio x Médio | 3                  |
| Implementar mais uma atividade lúdica, dessa vez voltada para o pré-adolescente | Baixo x Alto | 3                  |


