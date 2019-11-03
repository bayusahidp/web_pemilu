import serial

ser = serial.Serial("COM13", 9600)

while True:
    ambil_data = ser.readline()
    datastring = str(ambil_data)
    olah1 = ""
    buang1 = ""
    olah1, buang1 = datastring.split("-")
    buang3 = ""
    dapatdata = ""
    buang3, dapatdata = olah1.split("'")
    print(dapatdata)
    file = open("testfile.txt","w") 
     
    file.write(dapatdata)

file.close()
