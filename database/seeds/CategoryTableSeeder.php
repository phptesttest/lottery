<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //大
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'1',
        ]);
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'6',
        ]);
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'2',
        ]);
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'3',
        ]);
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'4',
        ]);
         DB::table('categories')->insert([
            'cName' =>'大',
            'rate' =>'1.96',
            'cId' =>'5',
        ]);

         //小
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'1',
        ]);
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'6',
        ]);
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'2',
        ]);
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'3',
        ]);
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'4',
        ]);
         DB::table('categories')->insert([
            'cName' =>'小',
            'rate' =>'1.96',
            'cId' =>'5',
        ]);

         //单
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'1',
        ]);
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'6',
        ]);
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'2',
        ]);
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'3',
        ]);
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'4',
        ]);
         DB::table('categories')->insert([
            'cName' =>'单',
            'rate' =>'1.96',
            'cId' =>'5',
        ]);

         //双
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'1',
        ]);
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'6',
        ]);
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'2',
        ]);
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'3',
        ]);
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'4',
        ]);
         DB::table('categories')->insert([
            'cName' =>'双',
            'rate' =>'1.96',
            'cId' =>'5',
        ]);

    }
}
