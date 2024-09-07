#include <iostream>

using namespace std;

int main()
{
    int usia;
    std::cout << "Masukkan usia Anda :";
    std::cin >> usia;

    if (usia < 13)
    {
        std::cout << "Anda Adalah Anak-Anak" << std::endl;
    }
    else if (usia > 13 && usia < 19)
    {
        std::cout << "Anda Adalah Remaja" << std::endl;
    }
    else if (usia > 20 && usia < 64)
    {
        std::cout << "Anda Adalah Dewasa" << std::endl;
    }
    else if (usia > 64)
    {
        std::cout << "Anda Adalah Lansia" << std::endl;
    }
    return 0;
}
