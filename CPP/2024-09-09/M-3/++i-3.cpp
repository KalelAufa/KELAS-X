#include <iostream>

int main () {
    const int SIZE = 7;
    int numbers[SIZE] = {23, 45, 67, 23, 100, 45, 56 };

    int totalPreIncrement = 0;
    std::cout << "Menggunakan ++i untuk menghitung total dan rata-rata" << std::endl;
    for (int i = 0; i < SIZE; ++i) {
        totalPreIncrement += numbers[i];
        std::cout << "Menambahkan" << numbers[i] << ", total sementara: " << totalPreIncrement << std::endl;
    }
    double averagePreIncrement = static_cast<double> (totalPreIncrement) /  SIZE;
    std::cout << "Total (pre-increment): " << totalPreIncrement << std::endl;
    std::cout << "Rata-rata (pre-increment): " << averagePreIncrement << std::endl;
}