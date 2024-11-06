#include <iostream>
#include <string>
using namespace std;

int main()
{
    string namaLengkap, namaPanggilan, namaPacar, jurusan, sekolah, alamat, hobi, citaCita;

    for (int j = 1; j <= 2; j++)
    {
        cout << "\nData Siswa ke " << j << endl;
        cout << "Nama Lengkap : ";
        getline(cin, namaLengkap);
        cout << "Nama Panggilan : ";
        getline(cin, namaPanggilan);
        cout << "Nama Pacar : ";
        getline(cin, namaPacar);
        cout << "Jurusan : ";
        getline(cin, jurusan);
        cout << "Sekolah : ";
        getline(cin, sekolah);
        cout << "Alamat : ";
        getline(cin, alamat);
        cout << "Hobi : ";
        getline(cin, hobi);
        cout << "Cita-Cita : ";
        getline(cin, citaCita);

        string identitas[8] = {
            "Nama Lengkap : " + namaLengkap,
            "Nama Panggilan : " + namaPanggilan,
            "Nama Pacar : " + namaPacar,
            "Jurusan : " + jurusan,
            "Sekolah : " + sekolah,
            "Alamat : " + alamat,
            "Hobi : " + hobi,
            "Cita-Cita : " + citaCita};

        cout << "\nIdentitas Pelajar: " << endl;
        for (string i : identitas)
        {
            cout << i << endl;
        }
    }
    return 0;
}
