## Instalação



- git clone https://github.com/wellingtonfds/studentbackr.git [nome do projeto]
- composer install
- comentar código em: app/providers/AuthServiceProvider

    *comentantar todo o trecho

    ```$this->registerPolicies($gate);
    $permissions = Permission::with('roles')->get();
    foreach ($permissions as $permission) {
        $gate->define($permission->name, function (User $user) use ($permission) {
            return $user->hasPermission($permission);
        });
    }
    $gate->before(function (User $user,$ability){
        if($user->hasAnyRoles('admin')){
            return true;
        }
    });```

 - acessar a pasta do projeto e executar:
    * php artisan migrante:install
    * php artisan migrate:refresh
    * php artison db:seed
 - O seed terá apenas os usuários e permissões. Apenas os usuários com nível de admin poderão executar as tarefas.
   Os demais usuários o acesso será restrito a tela home e com algumas messagens de acesso negado.
 - após esses comandos retirar o comentário do trecho em  app/providers/AuthServiceProvider
 - caso queria encontrar um usuário rapidamento pelo banco de dados utilizar essa consulta
 ```
 SELECT
    users.name,users.email,roles.name as role
    FROM studentbackr.users
 INNER JOIN studentbackr.role_user ON users.id = role_user.user_id
 INNER JOIN studentbackr.roles ON role_user.role_id = roles.id
 ```
 - a senha do usuário sempre será secret
