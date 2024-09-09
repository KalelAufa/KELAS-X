#include <iostream>

int main() {
    int i = 10;

    std::cout << "Menggunakan ++i" << std::endl;
    std::cout << "Sebelum :" << i << std::endl;
    std::cout << "Nilai ++i :" << ++i << std::endl;
    std::cout << "Setelah :" << i << std::endl;

    i = 20;
    std::cout << "Menggunakan i++" << std::endl;
    std::cout << "Sebelum :" << i << std::endl;
    std::cout << "Nilai ++i :" << i++ << std::endl;
    std::cout << "Setelah :" << i << std::endl;

    return 0;
}