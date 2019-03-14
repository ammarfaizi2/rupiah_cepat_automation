


var text = "test";
var key = CryptoJS.enc.Hex.parse('12f24fca6d6298fd1b7ff147559be43f');
var iv = CryptoJS.enc.Hex.parse('b095a68b22ec1debea760810a4515505');

var encrypted = CryptoJS.AES.encrypt(text, key, {iv: iv, padding: CryptoJS.pad.Pkcs7});



encrypted = "4FVFhitLWzxiHgNQ6zQ9roC03Ssz27SGUHnX7oTnKr9NdyBHdGh3yNTd9yHNn4ZRKwbITQ/oDCM2X48qj182OjGWbiErjaOcLlpxe8TnBSccAex3GLlcyQoRedZtfQQCKXoxNaSO1kv6IVOfs+yMuFQvVtlS7WAhwoXi2Vjb47eFjILhumo84IzHs/h4WUaaEdaxSu45gnbdan+uxkg9+28N2GrFQ4QMUgJbjeUJNWhe2YZ7REZsMKhbHuH5tLVEcI2JHvtObla+9nf20tbe2OAKEPmct/3jwoNCwRfhTgXneje38yJQ3hPXbf0NKdIlxmtgYZt2fGEkPEoomH7PQ8Yvhp5wnJrxT+H/VJcr3O2BqIg+2v9GqbPrPVeBv0f0orHV90B85oAFgcL0cOpsdeQC0LCDsTmDK05T+aMcjWtU5kNa8FerWn7zv1Heta+apecpC8gCInzjBmwjVUfVMzq7CjM1n5VPEYj2sW6Q6dj82asoH25RWn0K4WE+MrTxzkElnmIe6dI4rXNAIUxe9g7+Yh7IdluGMdiy+rHbLOvSkcDtiB1G18iijh+Z9mtJFMQP+5hvy9nSsFtOgxdhCR/ZlZPqOhdRUVJN8tk5KEIu8JlAJaKltdFYVzCGaAvUvx7HGI4JQmm4kBI2I2i38HPoj/+5jEtlIkBiCFrgCV0UdRH3hCl1mIBFRNxZHFzfWFX8mP7hj9ag1tDRnIXYdQPN7geWaCzw/TaChrU1QmgF5b376liSXrLsTZK5/9fxIeVfJIqpmIHoaXlgmBqnEN0VDPF5i1x7upEHFl0seSczdOhZVixfPJzKQ27OGE6t";
var key = CryptoJS.enc.Hex.parse('12f24fca6d6298fd1b7ff147559be43f');
var iv = CryptoJS.enc.Hex.parse('b095a68b22ec1debea760810a4515505');

CryptoJS.AES.decrypt(encrypted, key, {iv: iv, padding: CryptoJS.pad.Pkcs7}).toString(CryptoJS.enc.Utf8);

