<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // PELAJAR ---------------------------------------------------
        /*$userObj = new User();
        $userObj->name = 'Student Amir';
        $userObj->email = 'Student@gmail.com';
        $userObj->phone_number = '0102870049';
        $userObj->password = Hash::make('12345');
        $userObj->type = 1;
        $userObj->save();*/

        $userObj = new User();
        $userObj->name = 'Pelajar Iqmal';
        $userObj->email = 'PelajarIqmal@gmail.com';
        $userObj->phone_number = '0102870049';
        $userObj->student_id = '2023385531';
        $userObj->student_ic = '0102870049';
        $userObj->part = '6';
        $userObj->advisor = 'Sir Fakkah Fuzz';
        $userObj->password = Hash::make('12345');
        $userObj->type = 1;
        $userObj->save();

        $userObj = new User();
        $userObj->name = 'Pelajar Adib';
        $userObj->email = 'PelajarAdib@gmail.com';
        $userObj->phone_number = '0102870049';
        $userObj->student_id = '2023104593';
        $userObj->student_ic = '0102870049';
        $userObj->part = '5';
        $userObj->advisor = 'Sir Fazz Ahmad';
        $userObj->password = Hash::make('12345');
        $userObj->type = 1;
        $userObj->save();

        $userObj = new User();
        $userObj->name = 'Pelajar Akif';
        $userObj->email = 'PelajarAkif@gmail.com';
        $userObj->phone_number = '0102870049';
        $userObj->student_id = '2023393479';
        $userObj->student_ic = '0102870049';
        $userObj->part = '6';
        $userObj->advisor = 'Mdm Fazura Sha';
        $userObj->password = Hash::make('12345');
        $userObj->type = 1;
        $userObj->save();

        $userObj = new User();
        $userObj->name = 'Pelajar Zikry';
        $userObj->email = 'PelajarZikry@gmail.com';
        $userObj->phone_number = '0102870049';
        $userObj->student_id = '2023305725';
        $userObj->student_ic = '0102870049';
        $userObj->part = '6';
        $userObj->advisor = 'Sir Haliza Hani';
        $userObj->password = Hash::make('12345');
        $userObj->type = 1;
        $userObj->save();


        // PENSYARAH ---------------------------------------------------
        $adminObj = new User();
        $adminObj->name = 'Pensyarah Amir';
        $adminObj->email = 'Pensyarah@gmail.com';
        $adminObj->phone_number = '0102870049';
        $adminObj->password = Hash::make('12345');
        $adminObj->type = 2;
        $adminObj->save();

        $adminObj = new User();
        $adminObj->name = 'Pensyarah Iqmal';
        $adminObj->email = 'PensyarahIqmal@gmail.com';
        $adminObj->phone_number = '0102870049';
        $adminObj->password = Hash::make('12345');
        $adminObj->type = 2;
        $adminObj->save();

        $adminObj = new User();
        $adminObj->name = 'Pensyarah Adib';
        $adminObj->email = 'PensyarahAdib@gmail.com';
        $adminObj->phone_number = '0102870049';
        $adminObj->password = Hash::make('12345');
        $adminObj->type = 2;
        $adminObj->save();

        $adminObj = new User();
        $adminObj->name = 'Pensyarah Akif';
        $adminObj->email = 'PensyarahAkif@gmail.com';
        $adminObj->phone_number = '0102870049';
        $adminObj->password = Hash::make('12345');
        $adminObj->type = 2;
        $adminObj->save();

        $adminObj = new User();
        $adminObj->name = 'Pensyarah Zikry';
        $adminObj->email = 'PensyarahZikry@gmail.com';
        $adminObj->phone_number = '0102870049';
        $adminObj->password = Hash::make('12345');
        $adminObj->type = 2;
        $adminObj->save();


        // PENYELIA ---------------------------------------------------
        $AlumniObj = new User();
        $AlumniObj->name = 'Penyelia Amir';
        $AlumniObj->email = 'Penyelia@gmail.com';
        $AlumniObj->phone_number = '0102870049';
        $AlumniObj->password = Hash::make('12345');
        $AlumniObj->type = 3;
        $AlumniObj->save();

        $AlumniObj = new User();
        $AlumniObj->name = 'Penyelia Iqmal';
        $AlumniObj->email = 'PenyeliaIqmal@gmail.com';
        $AlumniObj->phone_number = '0102870049';
        $AlumniObj->password = Hash::make('12345');
        $AlumniObj->type = 3;
        $AlumniObj->save();

        $AlumniObj = new User();
        $AlumniObj->name = 'Penyelia Adib';
        $AlumniObj->email = 'PenyeliaAdib@gmail.com';
        $AlumniObj->phone_number = '0102870049';
        $AlumniObj->password = Hash::make('12345');
        $AlumniObj->type = 3;
        $AlumniObj->save();

        $AlumniObj = new User();
        $AlumniObj->name = 'Penyelia Akif';
        $AlumniObj->email = 'PenyeliaAkif@gmail.com';
        $AlumniObj->phone_number = '0102870049';
        $AlumniObj->password = Hash::make('12345');
        $AlumniObj->type = 3;
        $AlumniObj->save();

        $AlumniObj = new User();
        $AlumniObj->name = 'Penyelia Zikry';
        $AlumniObj->email = 'PenyeliaZikry@gmail.com';
        $AlumniObj->phone_number = '0102870049';
        $AlumniObj->password = Hash::make('12345');
        $AlumniObj->type = 3;
        $AlumniObj->save();
    }

    //php artisan db:seed

}
