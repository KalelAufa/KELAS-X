#include <iostream>

void printTriangle(int rows)
{
    for (int i = 1; i <= rows; ++i)
    {
        for (int j = 1; j <= rows - i; ++j)
        {
            std::cout << " ";
        }
        for (int k = 1; k <= (2 * i - 1); ++k)
        {
            std::cout << "~";
        }
        std::cout << std::endl;
    }
}

int main()
{
    int rows;

    std::cout << "Masukkan Jumlah baris untuk segitiga bintang: ";
    std::cin >> rows;

    printTriangle(rows);
    return 0;
}
