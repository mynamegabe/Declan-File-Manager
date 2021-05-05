def calcIC(ic):
    ic_digits = ic[1:-1]
    first_char = ic[0].lower()
    weight = [2,7,6,5,4,3,2]
    total = 0
    for i in range(0,7):
        total += weight[i] * int(ic_digits[i])
    if first_char == 't' or first_char == 'g':
        total += 4
    remainder = total % 11
    check = 11 - remainder
    dic1 = {
        1:"A",
        2:"B",
        3:"C",
        4:"D",
        5:"E",
        6:"F",
        7:"G",
        8:"H",
        9:"I",
        10:"J",
        11:"K"
        }
    dic2 = {
        1:"K",
        2:"L",
        3:"M",
        4:"N",
        5:"P",
        6:"Q",
        7:"R",
        8:"T",
        9:"U",
        10:"W",
        11:"X"
        }
    if first_char == "s" or first_char == "t":
        char = dic1[check]
    elif first_char == "f" or first_char == "g":
        char = dic2[check]
    if char == ic[-1]:
	print("Valid IC")
    else:
	print("Invalid IC")



calcIC("T1234567H")