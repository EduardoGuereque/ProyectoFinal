const canciones = [
    {
        id: 1,
        titulo: "El Triste",
        artista: "José José",
        anio: 1970,
        imagen: "public/assets/img/eltriste.jpeg",
        audio: "public/assets/audio/El Triste.mp3",
        descripcion: "“El Triste” es una de las canciones más icónicas de <strong>José José</strong>, interpretada por primera vez en el Festival OTI de 1970. Su poderosa interpretación consolidó al artista como una de las voces más importantes de la música romántica en español.",
        relacionadas: [2, 3, 4, 5]
    },
    {
        id: 2,
        titulo: "Gavilán o Paloma",
        artista: "José José",
        anio: 1977,
        imagen: "public/assets/img/gavilanopaloma.jpg",
        audio: "",
        descripcion: "Clásico romántico de José José...",
        relacionadas: [1, 3, 4]
    },
    {
        id: 3,
        titulo: "Amar y Querer",
        artista: "José José",
        anio: 1977,
        imagen: "public/assets/img/amaryquerer.jpg",
        audio: "",
        descripcion: "Éxito emblemático del artista...",
        relacionadas: [1, 2, 4]
    },
    {
        id: 4,
        titulo: "Almohada",
        artista: "José José",
        anio: 1978,
        imagen: "public/assets/img/almohada.jpg",
        audio: "",
        descripcion: "Uno de los temas más dolorosos y reconocidos, escrito por Adán Torres.",
        relacionadas: [1, 9, 10]
    },
    {
        id: 5,
        titulo: "Lo Pasado, Pasado",
        artista: "José José",
        anio: 1978,
        imagen: "public/assets/img/lopasadopasado.jpg",
        audio: "",
        descripcion: "Un himno al olvido y a la superación amorosa, con la colaboración de Juan Gabriel.",
        relacionadas: [1, 2, 3]
    },
    {
        id: 6,
        titulo: "El Amar y el Querer",
        artista: "José José",
        anio: 1977,
        imagen: "public/assets/img/elamaryelquerer.jpg",
        audio: "public/assets/audio/El Amar y el Querer.mp3",
        descripcion: "Una reflexión profunda sobre las diferencias entre el amor y el deseo.",
        relacionadas: [3, 12, 15]
    },
    {
        id: 7,
        titulo: "40 y 20",
        artista: "José José",
        anio: 1992,
        imagen: "public/assets/img/40y20.jpg",
        audio: "public/assets/audio/40 y 20.mp3",
        descripcion: "El tema que revitalizó su carrera en los 90s, abordando el amor con diferencia de edad.",
        relacionadas: [10, 13, 18]
    },
    {
        id: 8,
        titulo: "La Nave del Olvido",
        artista: "José José",
        anio: 1970,
        imagen: "public/assets/img/lanavedelolvido.jpg",
        audio: "public/assets/audio/La Nave del Olvido.mp3",
        descripcion: "El éxito que lo catapultó a la fama internacional antes de 'El Triste'.",
        relacionadas: [1, 9, 11]
    },
    {
        id: 9,
        titulo: "Volcán",
        artista: "José José",
        anio: 1978,
        imagen: "public/assets/img/volcan.jpg",
        audio: "public/assets/audio/Volcan.mp3",
        descripcion: "Balada potente sobre pasiones contenidas escrita por Rafael Pérez Botija.",
        relacionadas: [4, 5, 12]
    },
    {
        id: 10,
        titulo: "Amnesia",
        artista: "José José",
        anio: 1990,
        imagen: "public/assets/img/amnesia.jpg",
        audio: "public/assets/audio/Amnesia.mp3",
        descripcion: "Un éxito tardío pero monumental sobre el dolor de recordar.",
        relacionadas: [7, 13, 19]
    },
    {
        id: 11,
        titulo: "Preso",
        artista: "José José",
        anio: 1981,
        imagen: "public/assets/img/preso.jpg",
        audio: "public/assets/audio/Preso.mp3",
        descripcion: "Tema icónico sobre estar atrapado emocionalmente por una pareja.",
        relacionadas: [14, 16, 17]
    },
    {
        id: 12,
        titulo: "Si Me Dejas Ahora",
        artista: "José José",
        anio: 1979,
        imagen: "public/assets/img/simedejasahora.jpg",
        audio: "public/assets/audio/Si Me Dejas Ahora.mp3",
        descripcion: "Canción que dio nombre a uno de sus álbumes más exitosos.",
        relacionadas: [3, 9, 15]
    },
    {
        id: 13,
        titulo: "Desesperado",
        artista: "José José",
        anio: 1982,
        imagen: "public/assets/img/desesperado.jpg",
        audio: "public/assets/audio/Desesperado.mp3",
        descripcion: "Parte del álbum 'Mi Vida', una interpretación llena de angustia y fuerza.",
        relacionadas: [10, 14, 20]
    },
    {
        id: 14,
        titulo: "Lo Dudo",
        artista: "José José",
        anio: 1983,
        imagen: "public/assets/img/lodudo.jpg",
        audio: "public/assets/audio/Lo Dudo.mp3",
        descripcion: "El tema de apertura del legendario álbum 'Secretos'.",
        relacionadas: [11, 15, 16]
    },
    {
        id: 15,
        titulo: "He Renunciado a Ti",
        artista: "José José",
        anio: 1983,
        imagen: "public/assets/img/herenunciadoati.jpg",
        audio: "public/assets/audio/He Renunciado a Ti.mp3",
        descripcion: "Una de las baladas más coreadas del álbum 'Secretos'.",
        relacionadas: [12, 14, 18]
    },
    {
        id: 16,
        titulo: "Payaso",
        artista: "José José",
        anio: 1983,
        imagen: "public/assets/img/payaso.jpg",
        audio: "public/assets/audio/Payaso.mp3",
        descripcion: "Metáfora sobre ocultar la tristeza tras una sonrisa.",
        relacionadas: [11, 14, 17]
    },
    {
        id: 17,
        titulo: "Me Basta",
        artista: "José José",
        anio: 1982,
        imagen: "public/assets/img/mebasta.jpg",
        audio: "public/assets/audio/Me Basta.mp3",
        descripcion: "Tema romántico de entrega total incluido en el álbum 'Mi Vida'.",
        relacionadas: [11, 16, 19]
    },
    {
        id: 18,
        titulo: "Anda y Ve",
        artista: "José José",
        anio: 1983,
        imagen: "public/assets/img/andayve.jpg",
        audio: "public/assets/audio/Anda y Ve.mp3",
        descripcion: "Una despedida elegante y dolorosa, clásica de Manuel Alejandro.",
        relacionadas: [7, 15, 20]
    },
    {
        id: 19,
        titulo: "No Me Digas Que Te Vas",
        artista: "José José",
        anio: 1980,
        imagen: "public/assets/img/nomedigasquetevas.jpg",
        audio: "public/assets/audio/No Me Digas Que Te Vas.mp3",
        descripcion: "Éxito del álbum 'Amor, Amor', marcado por su estilo orquestal.",
        relacionadas: [10, 17, 13]
    },
    {
        id: 20,
        titulo: "¿Y Quién Puede Ser?",
        artista: "José José",
        anio: 1986,
        imagen: "public/assets/img/yquienpuedeser.jpg",
        audio: "public/assets/audio/Y Quien Puede Ser.mp3",
        descripcion: "Tema principal del álbum 'Siempre Contigo', un éxito de mediados de los 80.",
        relacionadas: [13, 14, 18]
    }
];
