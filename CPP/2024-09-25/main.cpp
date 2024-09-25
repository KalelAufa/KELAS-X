#include <iostream>
#include <string>

int  main(){
    std::string input;
    std::cout << "Masukkan sebuah string: ";
    std::getline(std::cin, input);

    std::string reversed = std::string(input.rbegin(), input.rend());
    std::cout << "String yang dibalik adalah : " << reversed << std::endl;

    // std::cout << "Panjang string adalah: "  << input.length() << std::endl;
    return 0;

}
