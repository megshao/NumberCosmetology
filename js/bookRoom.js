
function bookItem(iDate,iUser){
    this.date = iDate;
    this.user = iUser;
    this.numOfItem = 0;
    this.rooms = '';

    this.addRoom = function(aRoom){
        this.numOfItem++;
        this.rooms = this.rooms + aRoom + ';';
    };

    this.deleteRoom = function(dRoom){
        this.numOfItem--;
        this.rooms = this.rooms.replace(dRoom+';',"");
    };

}