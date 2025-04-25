# 💰 Sistema de Gestão Financeira

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4.svg?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20.svg?style=flat-square&logo=laravel)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.0-ffe700.svg?style=flat-square&logo=filament)](https://filamentphp.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.0-fb70a9.svg?style=flat-square&logo=livewire)](https://livewire.laravel.com)
[![Docker](https://img.shields.io/badge/Docker-24.0-2496ED.svg?style=flat-square&logo=docker)](https://docker.com)
[![Status](https://img.shields.io/badge/Status-Em%20Desenvolvimento-green.svg?style=flat-square)]()

Sistema moderno de gestão financeira pessoal desenvolvido com Laravel 12 e interface administrativa Filament 3. O projeto foi construído seguindo princípios SOLID e Clean Architecture, demonstrando boas práticas de desenvolvimento e arquitetura de software.

A aplicação utiliza Livewire para interações dinâmicas e Filament Admin para uma interface moderna e responsiva. Todo o ambiente é containerizado com Docker para facilitar o desenvolvimento e deploy.

## 🚀 Tecnologias

| Tecnologia | Versão | Descrição |
|------------|---------|-----------|
| PHP | 8.3 | Linguagem de programação |
| Laravel | 12.0 | Framework PHP |
| Filament | 3.0 | Admin Panel & Form Builder |
| Livewire | 3.0 | Full-stack Framework |
| MySQL | 8.0 | Banco de dados |
| Docker | 24.0 | Containerização |

## 📁 Estrutura do Projeto

```
financa/
├── app/
│   ├── Filament/           # Recursos do Filament (Resources, Widgets)
│   ├── Http/               # Controllers e Requests
│   ├── Models/             # Modelos do Eloquent
│   └── Services/           # Camada de serviços (Clean Architecture)
├── database/
│   ├── factories/          # Factories para testes
│   ├── migrations/         # Migrações do banco
│   └── seeders/           # Seeders com dados iniciais
├── docker/                 # Configurações Docker
├── tests/                  # Testes automatizados
└── resources/             # Views e assets
```

## 🛠️ Como Rodar

1. Clone o repositório
```bash
git clone https://github.com/seu-usuario/financa.git
cd financa
```

2. Copie o arquivo de ambiente
```bash
cp .env.example .env
```

3. Inicie os containers Docker
```bash
make up
# ou
docker-compose up -d
```

4. Instale as dependências e configure o projeto
```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

5. Rode os seeders para dados iniciais
```bash
docker-compose exec app php artisan db:seed
```

6. Acesse o sistema em `http://localhost:8000/admin`
   - Email: admin@admin.com
   - Senha: 123456

## ✨ Funcionalidades

### Categorias
- Cadastro de categorias com tipo (entrada/saída)
- Seleção de cor para identificação visual
- Escolha de ícone personalizado
- Organização por tipo de movimentação

### Lançamentos Financeiros
- Registro de receitas e despesas
- Categorização dos lançamentos
- Campos para valor, data, descrição e observações
- Validações de dados em tempo real

### Dashboard
- Gráfico de movimentações por categoria
- Análise mensal de entradas e saídas
- Totalizadores por período
- Interface intuitiva e responsiva

### Dados Iniciais
- Seeders com categorias comuns
- Lançamentos de exemplo
- Usuário administrador padrão

## 📸 Screenshots

![Dashboard](link-para-screenshot-dashboard)
![Categorias](link-para-screenshot-categorias)
![Lançamentos](link-para-screenshot-lancamentos)

## 👨‍💻 Autor

**Caio Costa**

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=flat-square&logo=github&logoColor=white)](https://github.com/seu-usuario)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=flat-square&logo=linkedin&logoColor=white)](https://linkedin.com/in/seu-usuario)

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
