-- 데이터베이스 생성 (존재하지 않으면)
CREATE DATABASE IF NOT EXISTS gsc CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- gsc 데이터베이스 사용
USE gsc;

-- student 테이블 생성
-- CREATE TABLE IF NOT EXISTS student (
--     no INT AUTO_INCREMENT PRIMARY KEY,           -- 순번 (자동 증가)
--     std_id VARCHAR(20) NOT NULL UNIQUE,          -- 학번 (유일)
--     id VARCHAR(20) NOT NULL UNIQUE,              -- 로그인 ID (유일)
--     password VARCHAR(100) NOT NULL,              -- 비밀번호 (해싱 필요)
--     name VARCHAR(50) NOT NULL,                   -- 이름
--     age TINYINT,                                      -- 나이
--     birth DATE                                    -- 생년월일
-- );


-- -- 데이터베이스 생성
-- CREATE DATABASE IF NOT EXISTS myapp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- -- 사용자 생성 (비밀번호는 'password123')
-- CREATE USER IF NOT EXISTS 'myuser'@'%' IDENTIFIED BY 'password123';

-- -- 권한 부여
-- GRANT ALL PRIVILEGES ON myapp.* TO 'myuser'@'%';
-- FLUSH PRIVILEGES;

-- -- 테이블 생성
-- USE myapp;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL UNIQUE,
    grade TINYINT,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS posts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL ,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_user FOREIGN KEY (user_id) REFERENCES users(id) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- 초기 데이터 삽입
-- INSERT INTO users (username, email) VALUES
-- ('alice', 'alice@example.com'),
-- ('bob', 'bob@example.com');



--


-- 게시판 테이블 생성
-- CREATE TABLE IF NOT EXISTS posts (
--     id INT AUTO_INCREMENT PRIMARY KEY,                              -- 게시글 ID
--     title VARCHAR(255) NOT NULL,                                    -- 제목
--     name VARCHAR(100) NOT NULL,                                     -- 작성자 이름
--     password VARCHAR(255) NOT NULL,                                 -- 비밀번호 (해시값)
--     content TEXT NOT NULL,                                          -- 내용
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,                  -- 작성 시각
--     updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP    -- 수정 시각 (수정 시 자동 갱신)
--     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- INSERT INTO posts (title, name, password, content)
-- VALUES
--     ('테스트 제목 1', '홍길동', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 1입니다.'),
--     ('테스트 제목 2', '김영희', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 2입니다.'),
--     ('테스트 제목 3', '이철수', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 3입니다.'),
--     ('테스트 제목 4', '박민수', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 4입니다.'),
--     ('테스트 제목 5', '최지은', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 5입니다.'),
--     ('테스트 제목 6', '강서준', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 6입니다.'),
--     ('테스트 제목 7', '윤하늘', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 7입니다.'),
--     ('테스트 제목 8', '정수빈', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 8입니다.'),
--     ('테스트 제목 9', '오예진', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 9입니다.'),
--     ('테스트 제목 10', '한서진', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 10입니다.'),
--     ('테스트 제목 11', '김도윤', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 11입니다.'),
--     ('테스트 제목 12', '이하늘', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 12입니다.'),
--     ('테스트 제목 13', '홍예빈', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 13입니다.'),
--     ('테스트 제목 14', '박건우', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 14입니다.'),
--     ('테스트 제목 15', '윤재희', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 15입니다.'),
--     ('테스트 제목 16', '김하늘', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 16입니다.'),
--     ('테스트 제목 17', '이소연', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 17입니다.'),
--     ('테스트 제목 18', '정예진', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 18입니다.'),
--     ('테스트 제목 19', '장준호', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 19입니다.'),
--     ('테스트 제목 20', '서하늘', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 20입니다.'),
--     ('테스트 제목 21', '김민정', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 21입니다.'),
--     ('테스트 제목 22', '박지우', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 22입니다.'),
--     ('테스트 제목 23', '최은서', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 23입니다.'),
--     ('테스트 제목 24', '이재훈', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 24입니다.'),
--     ('테스트 제목 25', '김다은', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 25입니다.'),
--     ('테스트 제목 26', '정민지', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 26입니다.'),
--     ('테스트 제목 27', '한지원', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 27입니다.'),
--     ('테스트 제목 28', '박채원', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 28입니다.'),
--     ('테스트 제목 29', '윤도현', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 29입니다.'),
--     ('테스트 제목 30', '이윤호', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 30입니다.'),
--     ('테스트 제목 31', '최민규', '$2y$10$USCrgB8FMRcAyVnz8dXgFuew5FWOKG.anoSXjrVNxqeOX7U/fMBu2', '내용 31입니다.');