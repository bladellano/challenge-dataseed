
# Desafio Api Dataseed

No desafio proposto pela empresa Dataseed, tive a oportunidade de desenvolver uma solução completa, aplicando diversas tecnologias e implementando recursos importantes.

Para lidar com a autenticação e autorização, integrei a biblioteca "tymon/jwt-auth", permitindo a geração e validação de tokens JWT, o que garantiu a segurança das rotas e endpoints.

Além disso, criei enpoints públicos e privados com operações CRUD para a entidade "user", permitindo o gerenciamento completo dos usuários no sistema. Utilizei boas práticas de desenvolvimento e as funcionalidades do framework Laravel para garantir a consistência e a eficiência das operações.

Para facilitar a automação de tarefas, implementei scripts Make, permitindo a execução simplificada de comandos comuns durante o desenvolvimento e deploy da aplicação.

Visando a fácil reprodução do ambiente de desenvolvimento, criei um Dockerfile e um Docker Compose que configuraram e orquestraram os serviços necessários. Isso incluiu a utilização do Nginx como servidor web, o PHP 8.1.17-fpm como interpretador PHP, o Mysql como banco de dados, o Redis como cache e o Supervisord para gerenciamento dos processos.

Além disso, forneci um arquivo `Insomnia.json` que está na raiz do projeto, que pode ser importado na ferramenta Insomnia, permitindo testar e explorar facilmente os endpoints implementados.

Com essa solução abrangente, pude demonstrar minhas habilidades técnicas e a capacidade de lidar com desafios complexos, oferecendo uma aplicação segura, escalável e automatizada.
## Requerido
- [Docker](https://www.docker.com/)
- [Docker Composer](https://docs.docker.com/compose/)
- [Make](https://linuxhint.com/install-use-make-ubuntu/)

## Executar localmente

Clonar o projeto
```bash
  git clone https://github.com/bladellano/challenge-dataseed.git
```

Vá para o diretório do projeto
```bash
  cd challenge-dataseed
  make install
```
E aguarde a montagem de toda a aplicação.

# Comandos Make para acesso rápido

#### Subir a aplicação
```bash
make up
```
#### Entrar no bash da aplicação
```bash
make in
```
#### Desligar a aplicação
```bash
make down
```
# Desenvolvido por

Esta aplicação foi desenvolvida por [Caio Dellano Nunes da Silva.](https://dellanosites.com.br/) 

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/bladellano/)


