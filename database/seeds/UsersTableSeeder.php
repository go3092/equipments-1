<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dbuser = [
        [
          //root
          'idusers' => '00000000-00000000-00000000-00000000',
          'name' => 'support',
          'email' => 'support@rak-group.co.id',
          'nik' => 'support12345',
          'role' => 'a',
          'active' => TRUE,
          'password' => bcrypt('support')
        ],
        [
          //root
          'idusers' => '00000001-00000001-00000001-00000001',
          'name' => ' nurcholis',
          'email' => 'nurcholis@rak-group.co.id',
          'nik' => ' nurcholis12345',
          'role' => 'a',
          'active' => TRUE,
          'password' => bcrypt('nurcholis')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.koc',
          'email' => 'lex.koc@rak-group.co.id',
          'nik' => 'lex.koc12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.koc')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.tbu',
          'email' => 'lex.tbu@rak-group.co.id',
          'nik' => 'lex.tbu12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.tbu')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.pam',
          'email' => 'lex.pam@rak-group.co.id',
          'nik' => 'lex.pam12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.pam')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => ' lex.cyi',
          'email' => 'lex.cyi@rak-group.co.id',
          'nik' => 'lex.cyi12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.cyi')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.cri',
          'email' => 'lex.cri@rak-group.co.id',
          'nik' => 'lex.cri12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.cri')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.cib',
          'email' => 'lex.cib@rak-group.co.id',
          'nik' => 'lex.cib12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.cib')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.pgn',
          'email' => 'lex.pgn@rak-group.co.id',
          'nik' => 'lex.pgn12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.pgn')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.tms',
          'email' => 'lex.tms@rak-group.co.id',
          'nik' => 'lex.tms12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.tms')
        ],
        [
          //spv
          'idusers' => Str::uuid(),
          'name' => 'lex.bbu',
          'email' => 'lex.bbu@rak-group.co.id',
          'nik' => 'lex.bbu12345',
          'role' => 'l',
          'active' => TRUE,
          'password' => bcrypt('lex.bbu')
        ],


        // [
        //   'idusers' => Str::uuid(),
        //   'name' => 'security',
        //   'email' => 'security@gmail.com',
        //   'nik' => 'security12345',
        //   'role' =>  's',
        //   'active' => TRUE,
        //   'password' => bcrypt('security')
        // ],
        [
          'idusers' => Str::uuid(),
          'name' => 'manager',
          'email' => 'manager@gmail.com',
          'nik' => 'manager12345',
          'role' =>  'm',
          'active' => TRUE,
          'password' => bcrypt('manager')
        ]
      ];

      DB::table('users')->insert($dbuser);
    }
  }
