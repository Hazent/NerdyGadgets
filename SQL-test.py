from sense_hat import SenseHat
import mysql.connector as mysql
from datetime import datetime
import time

sense = SenseHat()

while True:
    temp = sense.get_temperature()
    temp = float(round(temp, 2))

    now = datetime.now()

    date_time = now.strftime("%Y-%m-%d %H:%M:%S")
    
    nerdy = mysql.connect(
        host = "10.80.17.2",
        user = "raspPi",
        password = "",
        database = "nerdygadgets"
    )

    mycursor = nerdy.cursor()

    sql = "UPDATE coldroomtemperatures SET RecordedWhen = %s, Temperature = %s, ValidFrom = %s WHERE ColdRoomSensorNumber = '1'"
    val = (date_time, temp, date_time)
    mycursor.execute(sql, val)

    nerdy.commit()

    print(mycursor.rowcount, "record inserted")
    time.sleep(3)
